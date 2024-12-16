import ContentService from '../Services/content';
import Utils from '../classes/utils';
import { contentStatusCompleted, contentStatusReset } from 'musora-content-services';

export default (function () {
    document.addEventListener('DOMContentLoaded', () => {
        const markAsCompleteButtons = document.querySelectorAll('.completeButton');
        const addToListButtons = document.querySelectorAll('.addToList');
        const resetProgressButtons = document.querySelectorAll('.resetProgress');
        let clickTimeout = false;
        let isRequesting = false;
        let isResetCompleteOpened = false;

        window.addEventListener('vue-requesting-completion', (event) => {
            isRequesting = true;
        });

        window.addEventListener('vue-request-complete', (event) => {
            isRequesting = false;
        });

        //Good ol' fashion event delegation...
        document.addEventListener('click', (event) => {
            const element = event.target;

            //Clicking on addToList Button
            if (element.matches('.addToList')) {
                addToList(event);
            }

            //Clicking on .completeButton
            if (element.matches('.completeButton')) {
                markAsComplete(event);
            }

            //Clicking on .resetProgress
            if (element.matches('.resetProgress')) {
                progressReset(event);
            }
        });

        window.recalculateProgress = function (complete, master = false, brand = 'drumeo') {
            const numberOfAssignments = document.querySelectorAll('.assignment-component').length;
            const progressContainer = document.querySelector('.trophy-progress-bar');

            if (progressContainer) {
                const completeButton = document.querySelector('.completeButton');
                const completeUnderlay = document.querySelector('.white-underlay');
                const progressBar = document.querySelector('.trophy-progress');
                const progressText = progressBar.querySelector('.progress-percent');
                const currentProgress = progressBar ? progressBar.dataset.currentProgress : 0;
                const progressDifference = 100 / (master ? 1 : numberOfAssignments);
                let newProgress = null;

                if (complete) {
                    newProgress = Math.ceil(Number(currentProgress) + Number(progressDifference));
                } else {
                    newProgress = Math.floor(Number(currentProgress) - Number(progressDifference));
                }

                if (newProgress < 0) {
                    newProgress = 0;
                } else if (newProgress > 100) {
                    newProgress = 100;
                }

                if (progressBar) {
                    progressBar.style.transform = `translateX(${newProgress - 100}%)`;
                    progressBar.dataset.currentProgress = String(newProgress);
                    progressText.innerHTML = `${newProgress}%`;

                    if (newProgress <= 50) {
                        progressText.classList.add('right');
                    } else {
                        progressText.classList.remove('right');
                    }
                }

                if (newProgress >= 100) {
                    progressContainer.classList.add('complete');
                    if (completeButton) {
                        completeButton.classList.add('is-complete');
                    }
                    if (completeUnderlay) {
                        completeUnderlay.classList.add('visible');
                    }

                    Utils.triggerEvent(window, 'lesson-complete', { complete: true });
                } else {
                    progressContainer.classList.remove('complete');
                    if (completeButton) {
                        completeButton.classList.remove('is-complete');
                    }
                    if (completeUnderlay) {
                        completeUnderlay.classList.remove('visible');
                    }

                    if (newProgress <= 0) {
                        Utils.triggerEvent(window, 'lesson-complete', { complete: false });
                    }
                }
            }
        };

        function progressReset(event) {
            const element = event.target;
            const contentType = Utils.toTitleCase(element.dataset.contentType || 'content');
            const { contentId } = element.dataset;
            const brand = element.dataset.brand || 'drumeo';
            const icon = element.querySelector('.fas');

            if (!clickTimeout && !isResetCompleteOpened) {
                isResetCompleteOpened = true;
                
                window.showconfirmationmodal({
                    title: 'Hold your horses… This will reset all of your progress, are you sure about this?',
                    subtitle: 'This cannot be undone.',
                    callbacks: {
                        submit: () => {
                            icon.classList.remove('fa-redo-alt', 'fa-flip-horizontal');
                            icon.classList.add('fa-spin', 'fa-spinner');
                            
                            //Reset Progress!
                            contentStatusReset(contentId)
                                .then(() => {
                                    window.shownotification({
                                        icon: 'check',
                                        text: 'Removed! Your progress has been reset.'
                                    });
            
                                    if (document.querySelector('.trophy-progress')) {
                                        window.recalculateProgress(false, true, brand);
                                    }
                                    Array.from(resetProgressButtons).forEach((button) => {
                                        button.parentElement.classList.add('hide');
                                    });
                                }).finally( () => {
                                    icon.classList.remove('fa-spin', 'fa-spinner');
                                    icon.classList.add('fa-redo-alt', 'fa-flip-horizontal');
                                    //Hard Reload
                                    window.location.reload();
                                });
                        },
                        cancel: () => {
                            isResetCompleteOpened = false;
                        }
                    }
                });                
            }

            setClickTimeout();
        }

        function addToList(event) {
            const element = event.target;
            const { contentId } = element.dataset;
            const is_added = element.classList.contains('added');

            if (!clickTimeout) {
                ContentService.addOrRemoveContentFromList(contentId, is_added)
                    .then((response) => {
                        if (response) {
                            if (is_added) {
                                element.classList.add('add-request-complete');
                            } else {
                                element.classList.add('remove-request-complete');
                            }
                        }
                    });

                if (is_added) {
                    element.classList.remove('added', 'text-white');
                    element.classList.add('inverted');
                } else {
                    element.classList.add('added', 'text-white');
                    element.classList.remove('inverted');
                }
            }

            setClickTimeout();
        }

        function markAsComplete(event) {
            const element = event.target;
            const { contentId } = element.dataset;
            const isRemoving = element.classList.contains('is-complete');
            const brand = element.dataset.brand || 'drumeo';

            Utils.triggerEvent(window, 'requesting-completion'); 

            if (!clickTimeout && !isRequesting) {
                if (isRemoving) {
                    if (!isResetCompleteOpened) {
                        isResetCompleteOpened = true;
                        
                        window.showconfirmationmodal({
                            title: 'Hold your horses… This will reset all of your progress, are you sure about this?',
                            subtitle: 'This cannot be undone.',
                            callbacks: {
                                submit: () => {
                                    element.classList.remove('is-complete');
                        
                                    window.recalculateProgress(!isRemoving, true, brand);
                                    
                                    //Actually Reset Progress
                                    contentStatusReset(contentId)
                                        .then((resolved) => {
                                            if (resolved) {
                                                window.shownotification({
                                                    icon: 'check',
                                                    text: 'Ready to start again? Your progress has been reset.'
                                                });
                        
                                                element.classList.add('remove-request-complete');
                                            }
                        
                                            isRequesting = false;
                                        });
                                },
                                cancel: () => {
                                    isResetCompleteOpened = false;
                                }
                            }
                        });                        
                    }
                } else {
                    element.classList.add('is-complete');

                    //for Alpine JS Template Data
                    if(document.querySelector('[x-data]') &&
                        document.querySelector('[x-data]').__x &&
                        document.querySelector('[x-data]').__x.$data) {
                        //Trigger Modals if complete
                        if(element.classList.contains('lesson-complete')) {
                            document.querySelector('[x-data]').__x.$data.modalOpen = 'lessonComplete';
                        } else if (element.classList.contains('quest-complete')) {
                            document.querySelector('[x-data]').__x.$data.modalOpen = 'questComplete';
                        } else {
                            document.querySelector('[x-data]').__x.$data.modalOpen = 'levelComplete';
                        }
                    }

                    window.recalculateProgress(!isRemoving, true, brand);

                    //Mark As Complete!
                    contentStatusCompleted(contentId)
                        .then(() => {
                            element.classList.add('add-request-complete');
                        })
                        .finally( () => {
                            isRequesting = false;
                        });
                }
            }

            setClickTimeout();
        }

        function setClickTimeout() {
            clickTimeout = true;
            setTimeout(() => {
                clickTimeout = false;
            }, 200);
        }
    });
}());

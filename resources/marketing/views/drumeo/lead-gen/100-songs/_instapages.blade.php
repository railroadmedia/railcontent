<script>
    $(document).ready(function () {
        $('.autoplay-video').on('click', function () {
            var idOfOpenDiv = $(this).data('open');

            $('#' + idOfOpenDiv).find('[data-lazy-load-url]').each(function () {
                var lazyLoadIframeElement = $(this);
                $(this).attr('src', lazyLoadIframeElement.data('lazy-load-url'));
            });
        });
    });



    

</script>

<div class="widget item-absolute  " id="element-657">
    <a id="link-9kuevwm6sw" class="popup-link btn    item-block" data-at="button" data-link-9kuevwm6sw="" data-popup-link-9kuevwm6sw="" tabindex="0" role="button"></a>
</div>


<div id="popup-9kuevwm6sw" class="popup lightbox item-cover" data-at="modal" role="dialog" aria-modal="true" aria-label="dialog" tabindex="-1" data-type="" style="display: block;">
    <div class="lightbox-dim" tabindex="-1">
        <div class="lightbox-content">
            <button class="lightbox-close lightbox-close-btn item-cover item-absolute" tabindex="0" data-at="modal-close" aria-label="Close dialog">
                <svg xmlns="http://www.w3.org/2000/svg" height="26" width="26" class="lightbox-btn-svg">
                    <circle class="lightbox-close-icon" cx="13" cy="13" r="13"></circle>
                    <circle cx="13" cy="13" r="11"></circle>
                    <path class="lightbox-close-icon" d="M17.764 16.62l-1.144 1.144c-.158.157-.348.236-.573.236-.224 0-.415-.08-.572-.236L13 15.29l-2.475 2.474c-.157.157-.348.236-.572.236-.225 0-.415-.08-.573-.236L8.236 16.62C8.08 16.462 8 16.272 8 16.047c0-.224.08-.415.236-.572L10.71 13l-2.474-2.475C8.08 10.368 8 10.177 8 9.953c0-.225.08-.415.236-.573L9.38 8.236C9.538 8.08 9.728 8 9.953 8c.224 0 .415.08.572.236L13 10.71l2.475-2.474c.157-.157.348-.236.572-.236.225 0 .415.08.573.236l1.144 1.144c.157.158.236.348.236.573 0 .224-.08.415-.236.572L15.29 13l2.474 2.475c.157.157.236.348.236.572 0 .225-.08.415-.236.573z"></path>
                </svg>
            </button>
            <div data-at="modal-content">
                <div class="widget item-absolute  " id="element-658">
                    <div class="contents html-widget__text-center " data-at="html">
                        <iframe src="https://www.soundslice.com/slices/Ww4fc/embed/" width="100%" height="500" frameborder="0" allowfullscreen=""></iframe>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>







<a id="link-p16jlcvded" class="popup-link btn    item-block" data-at="button" data-link-p16jlcvded="" data-popup-link-p16jlcvded="" tabindex="0" role="button">
      
  </a>

/**
 * example of usage of the iframe
 * 
 * id="BlJyc" from the iframe src="https://www.soundslice.com/slices/BlJyc/embed/?api=1&amp;scroll_type=2&amp;branding=0"
 */

  <iframe src="" width="100%" height="500" frameborder="0" allowfullscreen id="BlJyc"></iframe>


/**
 * 
 * needs to be added to the footer 
 */
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var popupLinks = document.querySelectorAll('.popup-link');

            popupLinks.forEach(function(popupLink) {
                popupLink.addEventListener('click', function() {
                    var popupId = this.id.replace('link', 'popup');
                    var popup = document.getElementById(popupId);
                    var iframe = popup.querySelector('iframe');

                    var observer = new MutationObserver(function(mutations) {
                        mutations.forEach(function(mutation) {
                            if (mutation.attributeName === 'class') {
                                var classList = mutation.target.classList;
                                var prevClassList = mutation.oldValue ? mutation.oldValue.split(' ') : [];
                                var wasModalOn = prevClassList.includes('modal-on');
                                var isModalOn = classList.contains('modal-on');

                                if (wasModalOn !== isModalOn && isModalOn) {
                                    var iframeId = iframe.getAttribute('id');
                                    iframe.src = "https://www.soundslice.com/slices/" + iframeId + "/embed/";
                                } else {
                                    iframe.src = "";
                                }
                            }
                        });
                    });

                    observer.observe(document.body, {
                        attributes: true,
                        attributeOldValue: true
                    });
                });
            });
        });
    </script>

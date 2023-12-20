document.addEventListener('DOMContentLoaded', function () {
    const toggleClass = (element, className) => element.classList.toggle(className);
    const addClass = (element, className) => element.classList.add(className);
    const removeClass = (element, className) => element.classList.remove(className);

    const menuOverlay = document.querySelector(".menu-overlay");
    const sideBar = document.querySelector(".nav-side-bar");
    const nav = document.querySelector(".menu-toggle");
    const featuresWrap = document.querySelector(".edge-wrap .features");
    const instrumentsWrap = document.querySelector(".edge-wrap .instruments");
    const instrumentsDropdown = document.querySelector(".instruments-dd");
    const featuresDropdown = document.querySelector(".features-dd");
    const dropdownTogglers = document.querySelectorAll(".has-drop-down");
    const cookieNotice = document.querySelector(".cookie-notice");
    const acceptCookiesBtn = document.querySelector("#accept-cookies");
    let popUp = false;

    const toggleActiveClass = () => {
        toggleClass(sideBar, "active");
        toggleClass(menuOverlay, "active");
        toggleClass(nav, "active");
    };

    nav.addEventListener('click', toggleActiveClass);

    const toggleDropdowns = (element, dropdown1, dropdown2) => {
        element.addEventListener('click', function (e) {
            e.stopPropagation();
            addClass(dropdown1, "hidden");
            toggleClass(dropdown2, "hidden");
        });
    };

    toggleDropdowns(featuresWrap, instrumentsDropdown, featuresDropdown);
    toggleDropdowns(instrumentsWrap, featuresDropdown, instrumentsDropdown);

    window.addEventListener('click', function () {
        addClass(instrumentsDropdown, "hidden");
        addClass(featuresDropdown, "hidden");
    });

    menuOverlay.addEventListener('click', function (e) {
        e.stopPropagation();
        removeClass(menuOverlay, "active");
        removeClass(sideBar, "active");
        removeClass(nav, "active");
    });

    dropdownTogglers.forEach(function (toggler) {
        toggler.addEventListener('click', function (e) {
            e.stopPropagation();
            e.preventDefault();
            const arrowIcon = toggler.querySelector(".drop-down-arrow");
            const lessonLinks = toggler.nextElementSibling;
            toggleClass(lessonLinks, "active");
            toggleClass(arrowIcon, "active");
        });
    });

    const setPopUpCookie = () => {
        if (!popUp) {
            document.cookie = "cookieAccept=true; expires=" + new Date(2147483647 * 1000).toUTCString() + "; path=/;";
            popUp = true;
        }
    };

    acceptCookiesBtn.addEventListener('click', function () {
        addClass(cookieNotice, "hide");
        setPopUpCookie();
    });

    document.querySelectorAll('.anchor-slide').forEach(function (anchorSlide) {
        anchorSlide.addEventListener('click', function (event) {
            event.preventDefault();
            const anchor = anchorSlide.getAttribute('href').replace('/', '');
            window.scrollTo({
                top: document.querySelector(anchor).offsetTop,
                behavior: 'smooth'
            });
        });
    });
});

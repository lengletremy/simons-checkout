(function($) {
    $(document).ready(function() {
        var $tabs = $('.sw-tabs .sw-tab');

        $tabs.on('click', function() {
            var tab = $(this).data('sw-tab');

            $tabs.removeClass('sw-tab--active');
            $(this).addClass('sw-tab--active');

            $('.sw-tab-content').hide();
            $('.sw-tab-content--' + tab).show();
        });
    });
})(jQuery);

(function($) {
    $(document).ready(function() {
        // Tabs guest/login (déjà présent éventuellement)
        var $tabs = $('.sw-tabs .sw-tab');
        $tabs.on('click', function() {
            var tab = $(this).data('sw-tab');
            $tabs.removeClass('sw-tab--active');
            $(this).addClass('sw-tab--active');
            $('.sw-tab-content').hide();
            $('.sw-tab-content--' + tab).show();
        });

        // Fermeture de l'alerte livraison
        $(document).on('click', '.sw-cart-info-close', function () {
            $(this).closest('.sw-cart-info-banner').fadeOut(200);
        });
    });
})(jQuery);

(function($) {
    $(document).ready(function() {
        // Accordéons checkout
        $(document).on('click', '.sw-checkout-section-header', function() {
            var $section = $(this).closest('.sw-checkout-section');
            $section.toggleClass('sw-checkout-section--open');
            $section.find('.sw-checkout-section-body').slideToggle(180);
        });

        // (On peut garder ici ton code d'alerte/panier si tu l'as déjà)
    });
})(jQuery);

(function($) {
    $(document).ready(function() {
        // Tabs login / guest
        $(document).on('click', '.sw-co-login-tab', function() {
            var tab = $(this).data('sw-login-tab');

            $('.sw-co-login-tab').removeClass('sw-co-login-tab--active');
            $(this).addClass('sw-co-login-tab--active');

            $('.sw-co-login-panel').removeClass('sw-co-login-panel--active');
            $('.sw-co-login-panel--' + tab).addClass('sw-co-login-panel--active');
        });

        // Bouton "Valider" : simple scroll vers l'adresse
        $(document).on('click', '.sw-btn-validate-email', function() {
            var target = $('.sw-co-block--address');
            if (target.length) {
                $('html, body').animate({ scrollTop: target.offset().top - 80 }, 300);
            }
        });
    });
})(jQuery);

document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll(".sw-step1-tab");
    const panels = document.querySelectorAll(".sw-step1-panel");

    tabs.forEach(tab => {
        tab.addEventListener("click", () => {
            const target = tab.getAttribute("data-tab");

            tabs.forEach(t => t.classList.remove("sw-step1-tab--active"));
            panels.forEach(p => p.classList.remove("sw-step1-panel--active"));

            tab.classList.add("sw-step1-tab--active");
            document.querySelector(".sw-step1-panel--" + target)
                .classList.add("sw-step1-panel--active");
        });
    });
});


/*
 * StockManager Pro — JS maison (remplace bootstrap.bundle.min.js)
 * Gère la fermeture des alertes (équivalent de data-bs-dismiss="alert").
 */
(function () {
    'use strict';

    function closeAlert(alertEl) {
        alertEl.classList.add('closing');
        window.setTimeout(function () {
            alertEl.remove();
        }, 300);
    }

    function initDismissibleAlerts(root) {
        var scope = root || document;
        var closeButtons = scope.querySelectorAll('[data-dismiss="alert"], [data-bs-dismiss="alert"], .alert .btn-close');

        closeButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var alertEl = btn.closest('.alert');
                if (alertEl) {
                    closeAlert(alertEl);
                }
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        initDismissibleAlerts(document);
    });

    // Exposé au cas où d'autres scripts ajoutent des alertes dynamiquement
    window.StockManager = window.StockManager || {};
    window.StockManager.initDismissibleAlerts = initDismissibleAlerts;
})();

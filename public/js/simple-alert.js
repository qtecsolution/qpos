var alerts = document.querySelectorAll(".alert:not(.not_hide)");

setTimeout(function () {
    for (var i = 0; i < alerts.length; i++) {
        var alert = alerts[i];
        alert.style.transition = "height 0.5s, padding 0.5s, margin 0.5s";
        alert.style.overflow = "hidden";
        alert.style.maxHeight = alert.offsetHeight + "px";
        alert.style.padding = "0";
        alert.style.margin = "0";

        setTimeout(
            function (alert) {
                alert.style.maxHeight = alert.offsetHeight + "px";
                alert.style.padding = "0";
                alert.style.margin = "0";
            },
            10,
            alert
        );

        setTimeout(
            function (alert) {
                alert.style.maxHeight = "0";
                alert.style.paddingTop = "0";
                alert.style.paddingBottom = "0";
                alert.style.marginTop = "0";
                alert.style.marginBottom = "0";
            },
            20,
            alert
        );

        setTimeout(
            function (alert) {
                alert.style.display = "none";
            },
            500,
            alert
        );
    }
}, 2000);

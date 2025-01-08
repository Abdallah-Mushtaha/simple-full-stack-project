document.addEventListener('DOMContentLoaded', function () {
  
    document.addEventListener('selectstart', function (e) {
        e.preventDefault();
    });


    document.addEventListener('copy', function (e) {
        e.preventDefault();
        alert("عذرًا، النسخ غير مسموح!");
    });
});


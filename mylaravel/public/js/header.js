document.addEventListener("DOMContentLoaded", function() {
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            // Ngăn chặn sự kiện mặc định
            event.stopPropagation();
            
            // Gỡ bỏ lớp 'active' khỏi tất cả các liên kết
            navLinks.forEach(l => l.classList.remove('active'));
            // Thêm lớp 'active' vào liên kết hiện tại
            this.classList.add('active');
        });
    });

    // Thêm sự kiện click vào dữ liệu
    document.addEventListener('click', function() {
        // Gỡ bỏ lớp 'active' khỏi tất cả các liên kết khi nhấp ra ngoài
        navLinks.forEach(link => link.classList.remove('active'));
    });
});

document.addEventListener('DOMContentLoaded', function () {
        const dropdowns = document.querySelectorAll('.dropdown');

        dropdowns.forEach(dropdown => {
            const toggle = dropdown.querySelector('.dropdown-toggle');

            toggle.addEventListener('click', function (event) {
                event.preventDefault(); // Ngăn chặn hành vi mặc định

                // Đóng tất cả các dropdown khác
                dropdowns.forEach(d => {
                    if (d !== dropdown) {
                        d.querySelector('.dropdown-menu').classList.remove('show');
                    }
                });

                // Chuyển đổi dropdown hiện tại
                const menu = dropdown.querySelector('.dropdown-menu');
                menu.classList.toggle('show');
            });

            // Đóng dropdown khi nhấp vào mục
            dropdown.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function () {
                    // Đóng dropdown hiện tại
                    const menu = dropdown.querySelector('.dropdown-menu');
                    menu.classList.remove('show');
                });
            });
        });

        // Đóng tất cả dropdown khi nhấp ra ngoài
        document.addEventListener('click', function (event) {
            if (!event.target.closest('.dropdown')) {
                dropdowns.forEach(dropdown => {
                    dropdown.querySelector('.dropdown-menu').classList.remove('show');
                });
            }
        });
    });
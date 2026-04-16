<footer class="main-footer">
    <button id="backToTop" onclick="scrollToTop()" title="Go to top">
        <i class='bx bx-chevron-up'></i>
    </button>

    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About KayFood</h3>
                <p>We bring you traditional Vietnamese dishes with a rich flavor and the freshest ingredients every day.</p>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-facebook-circle'></i></a>
                    <a href="#"><i class='bx bxl-instagram'></i></a>
                    <a href="#"><i class='bx bxl-tiktok'></i></a>
                </div>
            </div>

            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="quick-links">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="food.php">Food</a></li>
                    <li><a href="drink.php">Drink</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Contact</h3>
                <ul class="contact-info">
                    <li><i class='bx bxs-map'></i> 69/68 Đặng Thùy Trâm, TP.HCM</li>
                    <li><i class='bx bxs-phone'></i> Hotline: 1900 1234</li>
                    <li><i class='bx bxs-envelope'></i> info@kayfood.vn</li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Opening Hours</h3>
                <p class="hours">Mon - Fri: <span>08:00 - 22:00</span></p>
                <p class="hours">Sat - Sun: <span>07:00 - 23:00</span></p>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2026 KayFood. All rights reserved.</p>
        </div>
    </div>
</footer>

<script>
// Hàm cuộn lên đầu trang mượt mà
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}
</script>
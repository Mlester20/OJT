<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-logo-info">
                <img src="../images/isu-logo.png" alt="ISU Logo" style="max-width: 80px; height: auto; margin-right: 10px;">
                <div class="footer-info">
                    <h4>Isabela State University</h4>
                    <p class="tagline">A leading research University in the ASEAN region</p>
                </div>
            </div>
            <div class="footer-credits">
                <p class="credits">© <?= date('Y'); ?> Isabela State University. All rights reserved.</p>
                <p class="credits">Developed by Mark Lester Raguindin</p>
            </div>
        </div>
    </div>
</footer>

<style>
body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    margin: 0;
}

.site-footer {
    background-color: #333;
    color: white;
    padding: 20px 0;
    margin-top: auto;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.footer-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    text-align: center;
}

.footer-logo-info {
    display: flex;
    align-items: center;
    flex: 1;
    text-align: left;
}

.footer-info {
    margin-left: 10px;
}

.footer-credits {
    flex: 1;
    text-align: right;
}

.footer-info h4 {
    font-size: 20px;
    margin-bottom: 5px;
    color: #fff;
}

.tagline {
    font-style: italic;
    color: #ccc;
    margin-bottom: 10px;
}

.credits {
    color: #ccc;
    margin-bottom: 5px;
}

.footer-logo img {
    max-width: 80px;
    height: auto;
}

@media (max-width: 768px) {
    .footer-content {
        flex-direction: column;
        text-align: center;
    }
    
    .footer-logo-info, .footer-credits {
        text-align: center;
        margin-top: 10px;
    }
}
</style>
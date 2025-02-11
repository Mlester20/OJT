<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-info">
                <h4>Isabela State University</h4>
                <p class="tagline">A leading research University in the ASEAN region</p>
                <p class="copyright">Copyright © <?= date('Y'); ?> Mark Lester Raguindin || Benedict Hernando </p>
                
                <!-- <div class="visitor-stats">
                    <p>Online Visitors: 286,997</p>
                    <p>Today's Visitors: 511</p>
                    <p>Total Page Views: 200,627</p>
                </div> -->

            </div>
            
            <div class="footer-logo">
                <img src="../images/isu-logo.png" alt="">
            </div>
        </div>
    </div>
</footer>

<style>
.site-footer {
    background-color: #333;
    color: white;
    padding: 40px 0;
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
}

.footer-info {
    flex: 2;
}

.footer-info h2 {
    font-size: 24px;
    margin-bottom: 10px;
    color: #fff;
}

.tagline {
    font-style: italic;
    color: #ccc;
    margin-bottom: 20px;
}

.contact-link a {
    color: white;
    text-decoration: none;
}

.contact-link a:hover {
    text-decoration: underline;
}

.copyright {
    color: #ccc;
    margin: 10px 0;
}

.visitor-stats {
    margin-top: 20px;
    color: #ccc;
}

.visitor-stats p {
    margin: 5px 0;
}

.footer-logo {
    flex: 1;
    text-align: right;
}

.footer-logo img {
    max-width: 100px;
    height: auto;
}

.social-links {
    position: absolute;
    right: 20px;
    margin-top: 200px;
    display: flex;
    gap: 10px;
}

.social-icon {
    display: inline-block;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    transition: transform 0.3s ease;
}

.social-icon:hover {
    transform: translateY(-3px);
}

.social-icon img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

@media (max-width: 768px) {
    .footer-content {
        flex-direction: column;
        text-align: center;
    }
    
    .footer-logo {
        margin-top: 20px;
        text-align: center;
    }
    
    .social-links {
        position: static;
        margin-top: 20px;
        justify-content: center;
    }
}
</style>
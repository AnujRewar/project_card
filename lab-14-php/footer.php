<style>
    /* Footer Styles */
    .footer {
        padding: 60px 30px 30px;
        background: var(--primary-black);
        border-top: 1px solid var(--metal-dark);
        position: relative;
    }

    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 40px;
        margin-bottom: 40px;
    }

    .footer-brand {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .footer-logo {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .footer-description {
        color: var(--text-secondary);
        line-height: 1.6;
        font-size: 14px;
    }

    .footer-social {
        display: flex;
        gap: 15px;
    }

    .social-icon {
        width: 40px;
        height: 40px;
        background: var(--carbon-medium);
        border: 1px solid var(--metal-dark);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-secondary);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
        border-color: var(--accent-purple);
        color: var(--text-primary);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(153, 69, 255, 0.3);
    }

    .footer-section h4 {
        color: var(--text-primary);
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 16px;
    }

    .footer-links {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .footer-links a {
        color: var(--text-secondary);
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .footer-links a:hover {
        color: var(--accent-purple);
        padding-left: 10px;
    }

    .footer-bottom {
        padding-top: 30px;
        border-top: 1px solid var(--metal-dark);
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
    }

    .copyright {
        color: var(--text-dim);
        font-size: 14px;
    }

    .footer-credits {
        color: var(--text-dim);
        font-size: 14px;
    }

    .footer-credits a {
        color: var(--accent-purple);
        text-decoration: none;
    }

    .footer-credits a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .footer-content {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .footer-bottom {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }
    }
</style>

<footer class="footer">
    <div class="footer-content">
        <div class="footer-brand">
            <div class="footer-logo">
                <div class="logo-icon">
                    <div class="logo-prism">
                        <div class="prism-shape"></div>
                    </div>
                </div>
                <span class="logo-text">
                    <span class="prism">PRISM</span>
                    <span class="flux">FLUX</span>
                </span>
            </div>
            <p class="footer-description">
                Refracting complex challenges into brilliant solutions through the convergence of art, science, and technology.
            </p>
            <div class="footer-social">
                <a href="#" class="social-icon">f</a>
                <a href="#" class="social-icon">t</a>
                <a href="#" class="social-icon">in</a>
                <a href="#" class="social-icon">ig</a>
            </div>
        </div>
        
        <div class="footer-section">
            <h4>Services</h4>
            <div class="footer-links">
                <a href="visitingcard.php">Visiting Cards</a>
                <a href="#">Web Development</a>
                <a href="#">App Development</a>
                <a href="#">Digital Solutions</a>
            </div>
        </div>
        
        <div class="footer-section">
            <h4>Company</h4>
            <div class="footer-links">
                <a href="#about">About Us</a>
                <a href="#">Our Team</a>
                <a href="#">Careers</a>
                <a href="#">Contact</a>
            </div>
        </div>
        
        <div class="footer-section">
            <h4>Resources</h4>
            <div class="footer-links">
                <a href="#">Documentation</a>
                <a href="#">Blog</a>
                <a href="#">Support</a>
                <a href="#">Privacy Policy</a>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="copyright">
            © 2024 PRISM FLUX. All rights reserved.
        </div>
        <div class="footer-credits">
            Digital Innovation Studio
        </div>
    </div>
</footer>
</body>
</html>

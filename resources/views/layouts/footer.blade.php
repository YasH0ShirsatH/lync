<!-- Footer -->
<footer class="footer-section">
    <div class="footer-content">
        <div class="footer-grid">
            <div class="footer-column">
                <div class="footer-brand">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Lync</span>
                </div>
                <p class="footer-description">
                    Modern Learning Management System empowering education through innovative technology.
                </p>
            </div>
            
            <div class="footer-column">
                <h4 class="footer-title">Help & Support</h4>
                <ul class="footer-links">
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Contact Support</a></li>
                    <li><a href="#">User Guide</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h4 class="footer-title">Legal</h4>
                <ul class="footer-links">
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                    <li><a href="#">GDPR</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h4 class="footer-title">Connect</h4>
                <div class="social-links">
                    <a href="#" class="social-link">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Lync. All rights reserved.</p>
        </div>
    </div>
</footer>

<style>
/* Footer Styles */
.footer-section {
    background: white;
    border-top: 1px solid #e2e8f0;
    margin-top: 4rem;
}

.footer-content {
    padding: 3rem 0 1.5rem;
    max-width: 1400px;
    margin: 0 auto;
    padding-left: 1rem;
    padding-right: 1rem;
}

.footer-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 2rem;
    margin-bottom: 2rem;
}

.footer-brand {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1.5rem;
    font-weight: 700;
    color: #0284c7;
    margin-bottom: 1rem;
}

.footer-description {
    color: #64748b;
    font-size: 0.875rem;
    line-height: 1.6;
    max-width: 300px;
}

.footer-title {
    font-size: 1rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 1rem;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 0.5rem;
}

.footer-links a {
    color: #64748b;
    text-decoration: none;
    font-size: 0.875rem;
    transition: color 0.2s ease;
}

.footer-links a:hover {
    color: #0284c7;
}

.social-links {
    display: flex;
    gap: 0.75rem;
}

.social-link {
    width: 40px;
    height: 40px;
    background: #f1f5f9;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748b;
    text-decoration: none;
    transition: all 0.2s ease;
}

.social-link:hover {
    background: #0284c7;
    color: white;
    transform: translateY(-2px);
}

.footer-bottom {
    border-top: 1px solid #e2e8f0;
    padding-top: 1.5rem;
    text-align: center;
}

.footer-bottom p {
    color: #64748b;
    font-size: 0.875rem;
    margin: 0;
}

@media (max-width: 768px) {
    .footer-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .footer-content {
        padding: 2rem 1rem 1rem;
    }
}
</style>
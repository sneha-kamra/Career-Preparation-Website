<?php
session_start();
$practice_link = isset($_SESSION['user_id']) ? 'practice.php' : 'login.php';
$get_started_link = isset($_SESSION['user_id']) ? 'dashboard.php' : 'register.php';
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #f1f5f9, #e0e7ff, #eff6ff);
        color: #1e293b;
        overflow-x: hidden;
    }

    .homepage {
        width: 100%;
        position: relative;
    }

    .homepage::before {
        content: "";
        position: fixed;
        top: -100px;
        left: -100px;
        width: 280px;
        height: 280px;
        background: rgba(59, 130, 246, 0.12);
        border-radius: 50%;
        filter: blur(30px);
        z-index: -1;
    }

    .homepage::after {
        content: "";
        position: fixed;
        right: -120px;
        bottom: -120px;
        width: 320px;
        height: 320px;
        background: rgba(79, 70, 229, 0.12);
        border-radius: 50%;
        filter: blur(35px);
        z-index: -1;
    }

    .container-custom {
        max-width: 1200px;
        margin: auto;
        padding: 0 20px;
    }

    .section {
        padding: 100px 0;
        position: relative;
    }

    .section-title {
        text-align: center;
        font-size: 40px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 16px;
    }

    .section-subtitle {
        text-align: center;
        max-width: 760px;
        margin: 0 auto 50px;
        color: #64748b;
        font-size: 17px;
        line-height: 1.8;
    }

    .hero-section {
        padding: 100px 0 80px;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: "";
        position: absolute;
        top: -120px;
        right: -120px;
        width: 320px;
        height: 320px;
        border-radius: 50%;
        background: rgba(59, 130, 246, 0.12);
        filter: blur(15px);
        z-index: 0;
    }

    .hero-section::after {
        content: "";
        position: absolute;
        bottom: -100px;
        left: -100px;
        width: 280px;
        height: 280px;
        border-radius: 50%;
        background: rgba(37, 99, 235, 0.10);
        filter: blur(15px);
        z-index: 0;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 55px;
        align-items: center;
    }

    .hero-left h5 {
        display: inline-block;
        padding: 10px 18px;
        border-radius: 999px;
        background: rgba(255,255,255,0.7);
        backdrop-filter: blur(10px);
        color: #2563eb;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 20px;
        letter-spacing: 0.8px;
        border: 1px solid rgba(255,255,255,0.7);
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
    }

    .hero-left h1 {
        font-size: 56px;
        font-weight: 800;
        line-height: 1.15;
        margin-bottom: 20px;
        color: #0f172a;
    }

    .hero-left h1 span {
        color: #2563eb;
    }

    .hero-left p {
        font-size: 18px;
        color: #475569;
        line-height: 1.8;
        margin-bottom: 30px;
        max-width: 680px;
    }

    .hero-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 25px;
    }

    .btn-main,
    .btn-outline {
        text-decoration: none;
        padding: 14px 28px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 16px;
        transition: all 0.35s ease;
        display: inline-block;
    }

    .btn-main {
        background: linear-gradient(90deg, #2563eb, #4f46e5);
        color: #fff;
        box-shadow: 0 14px 30px rgba(37, 99, 235, 0.25);
    }

    .btn-main:hover {
        background: linear-gradient(90deg, #1d4ed8, #4338ca);
        transform: translateY(-4px);
        box-shadow: 0 18px 35px rgba(37, 99, 235, 0.28);
    }

    .btn-outline {
        border: 1px solid rgba(255,255,255,0.7);
        color: #1e293b;
        background: rgba(255,255,255,0.75);
        backdrop-filter: blur(10px);
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
    }

    .btn-outline:hover {
        background: rgba(255,255,255,0.95);
        transform: translateY(-4px);
    }

    .hero-mini-info {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .mini-pill {
        background: rgba(255,255,255,0.72);
        backdrop-filter: blur(10px);
        padding: 10px 14px;
        border-radius: 999px;
        font-size: 14px;
        color: #334155;
        font-weight: 600;
        border: 1px solid rgba(255,255,255,0.7);
        box-shadow: 0 10px 20px rgba(15, 23, 42, 0.05);
    }

    .hero-right {
        display: flex;
        justify-content: center;
    }

    .hero-image-box {
        position: relative;
        width: 100%;
        max-width: 510px;
        border-radius: 28px;
        overflow: hidden;
        background: rgba(255,255,255,0.75);
        backdrop-filter: blur(14px);
        border: 1px solid rgba(255,255,255,0.75);
        box-shadow: 0 30px 80px rgba(15, 23, 42, 0.18);
        transform: translateY(-10px);
        animation: floatHero 4s ease-in-out infinite;
    }

    .hero-image-box img {
        width: 100%;
        height: 100%;
        min-height: 560px;
        object-fit: cover;
        display: block;
        transition: 0.5s ease;
        filter: brightness(1.08);
    }

    .hero-image-box:hover img {
        transform: scale(1.05);
    }

    .hero-image-box::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15, 23, 42, 0.18), rgba(15, 23, 42, 0.02));
        pointer-events: none;
    }

    .image-badge {
        position: absolute;
        bottom: 20px;
        left: 20px;
        background: rgba(255,255,255,0.94);
        backdrop-filter: blur(10px);
        padding: 10px 18px;
        border-radius: 999px;
        font-weight: 700;
        color: #2563eb;
        box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        z-index: 2;
    }

    .hero-strip {
        margin-top: -25px;
        position: relative;
        z-index: 4;
    }

    .strip-box {
        background: rgba(255,255,255,0.82);
        backdrop-filter: blur(14px);
        border-radius: 24px;
        box-shadow: 0 20px 50px rgba(15, 23, 42, 0.08);
        padding: 28px;
        border: 1px solid rgba(255,255,255,0.7);
    }

    .strip-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
    }

    .strip-item {
        text-align: center;
        padding: 18px 14px;
        border-radius: 18px;
        background: rgba(255,255,255,0.72);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.7);
        transition: 0.35s ease;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.05);
    }

    .strip-item:hover {
        transform: translateY(-6px) scale(1.02);
        border-color: #93c5fd;
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
    }

    .strip-item h3 {
        font-size: 18px;
        color: #2563eb;
        margin-bottom: 8px;
        font-weight: 800;
    }

    .strip-item p {
        font-size: 14px;
        color: #475569;
        line-height: 1.6;
    }

    .cards-grid-4,
    .cards-grid-3,
    .steps-grid,
    .placement-grid {
        display: grid;
        gap: 24px;
    }

    .cards-grid-4 {
        grid-template-columns: repeat(4, 1fr);
    }

    .cards-grid-3,
    .placement-grid {
        grid-template-columns: repeat(3, 1fr);
    }

    .steps-grid {
        grid-template-columns: repeat(4, 1fr);
    }

    .feature-card,
    .placement-card,
    .step-card,
    .about-card,
    .course-card,
    .cta-box {
        background: rgba(255,255,255,0.82);
        backdrop-filter: blur(14px);
        border-radius: 22px;
        padding: 28px;
        box-shadow: 0 20px 50px rgba(15, 23, 42, 0.08);
        border: 1px solid rgba(255,255,255,0.7);
        transition: all 0.35s ease;
    }

    .feature-card:hover,
    .placement-card:hover,
    .step-card:hover,
    .about-card:hover,
    .course-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 30px 60px rgba(15, 23, 42, 0.12);
        border-color: #93c5fd;
    }

    .icon-box {
        width: 58px;
        height: 58px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 18px;
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        border: 1px solid #93c5fd;
        box-shadow: 0 12px 25px rgba(37, 99, 235, 0.12);
    }

    .feature-card h3,
    .placement-card h3,
    .step-card h3,
    .course-card h3 {
        font-size: 22px;
        color: #0f172a;
        margin-bottom: 12px;
        font-weight: 800;
    }

    .feature-card p,
    .placement-card p,
    .step-card p,
    .about-card p,
    .course-card p {
        color: #64748b;
        font-size: 15px;
        line-height: 1.85;
    }

    .course-card {
        background: rgba(239, 246, 255, 0.85);
    }

    .course-badge {
        display: inline-block;
        padding: 8px 12px;
        background: #eff6ff;
        color: #2563eb;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 14px;
        border: 1px solid #93c5fd;
        box-shadow: 0 8px 18px rgba(37, 99, 235, 0.08);
    }

    .placement-section {
        position: relative;
    }

    .placement-section::before {
        content: "";
        position: absolute;
        top: 30px;
        right: 50px;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(59, 130, 246, 0.08);
        filter: blur(20px);
        z-index: 0;
    }

    .placement-section .container-custom {
        position: relative;
        z-index: 2;
    }

    .about-showcase {
        max-width: 1080px;
        margin: auto;
        background: rgba(255,255,255,0.84);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(255,255,255,0.75);
        border-radius: 28px;
        padding: 34px;
        box-shadow: 0 24px 55px rgba(15, 23, 42, 0.08);
    }

    .about-top {
        text-align: center;
        margin-bottom: 28px;
    }

    .about-top span {
        display: inline-block;
        padding: 10px 18px;
        border-radius: 999px;
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #93c5fd;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.6px;
        margin-bottom: 18px;
        box-shadow: 0 8px 18px rgba(37, 99, 235, 0.08);
    }

    .about-top h3 {
        font-size: 34px;
        line-height: 1.25;
        color: #0f172a;
        margin-bottom: 14px;
        font-weight: 800;
    }

    .about-top h3 span {
        background: linear-gradient(90deg, #2563eb, #4f46e5);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        border: none;
        padding: 0;
        margin: 0;
    }

    .about-top p {
        max-width: 820px;
        margin: 0 auto;
        color: #64748b;
        font-size: 16px;
        line-height: 1.9;
    }

    .about-points {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
        margin-top: 26px;
    }

    .about-card h4 {
        font-size: 20px;
        color: #0f172a;
        margin-bottom: 10px;
        font-weight: 800;
    }

    .step-number {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(90deg, #2563eb, #4f46e5);
        color: #fff;
        font-weight: 800;
        margin-bottom: 18px;
        box-shadow: 0 10px 24px rgba(37, 99, 235, 0.24);
    }

    .cta-section {
        padding: 0 0 95px;
    }

    .cta-box {
        max-width: 1100px;
        margin: auto;
        text-align: center;
        padding: 56px 30px;
        background: url('https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&w=1400&q=80') center/cover no-repeat;
        color: #fff;
        border: 1px solid rgba(255,255,255,0.25);
        overflow: hidden;
        box-shadow: 0 28px 60px rgba(15, 23, 42, 0.12);
        position: relative;
        border-radius: 22px;
    }

    .cta-box::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(15, 23, 42, 0.45);
        z-index: 1;
    }

    .cta-box h2,
    .cta-box p,
    .cta-box .hero-buttons {
        position: relative;
        z-index: 2;
    }

    .cta-box h2 {
        font-size: 38px;
        margin-bottom: 15px;
        font-weight: 800;
    }

    .cta-box p {
        color: #f8fafc;
        font-size: 17px;
        max-width: 760px;
        margin: 0 auto 28px;
        line-height: 1.8;
    }

    .reveal {
        opacity: 0;
        transform: translateY(50px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }

    .reveal.show {
        opacity: 1;
        transform: translateY(0);
    }

    @keyframes floatHero {
        0% {
            transform: translateY(-10px);
        }
        50% {
            transform: translateY(-22px);
        }
        100% {
            transform: translateY(-10px);
        }
    }

    @media (max-width: 1024px) {
        .hero-content {
            grid-template-columns: 1fr;
        }

        .cards-grid-4,
        .steps-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .cards-grid-3,
        .placement-grid,
        .about-points,
        .strip-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .hero-left h1 {
            font-size: 46px;
        }

        .hero-image-box img {
            min-height: 420px;
        }
    }

    @media (max-width: 768px) {
        .hero-left h1 {
            font-size: 34px;
        }

        .section-title,
        .about-top h3,
        .cta-box h2 {
            font-size: 28px;
        }

        .cards-grid-4,
        .cards-grid-3,
        .steps-grid,
        .placement-grid,
        .about-points,
        .strip-grid {
            grid-template-columns: 1fr;
        }

        .hero-buttons {
            flex-direction: column;
            align-items: stretch;
        }

        .btn-main,
        .btn-outline {
            width: 100%;
            text-align: center;
        }

        .hero-strip {
            margin-top: -8px;
        }

        .hero-image-box img {
            min-height: 320px;
        }
    }
</style>

<div class="homepage">

    <section class="hero-section">
        <div class="container-custom">
            <div class="hero-content">

                <div class="hero-left reveal">
                  <h5>PLACEMENT PREPARATION • PRACTICE • MOCK TESTS</h5>

                    <h1>
                        Launch Your <span>Career Journey</span> With Smart Preparation
                    </h1>

                    <p>
                        CareerPrep helps students prepare for placements through a complete system of learning, practice, mock testing, and performance analysis — all in one platform.
                    </p>

                    <div class="hero-buttons">
                        <a href="<?php echo $get_started_link; ?>" class="btn-main">Get Started</a>
                        <a href="<?php echo $practice_link; ?>" class="btn-outline">Start Practice</a>
                    </div>

                    <div class="hero-mini-info">
                        <span class="mini-pill">✔ Learn Skills</span>
                        <span class="mini-pill">✔ Practice Questions</span>
                        <span class="mini-pill">✔ Mock Tests</span>
                        <span class="mini-pill">✔ Track Progress</span>
                    </div>
                </div>

                <div class="hero-right reveal">
                    <div class="hero-image-box">
                        <img src="https://images.unsplash.com/photo-1571260899304-425eee4c7efc?auto=format&fit=crop&w=900&q=80" alt="students preparing for placement">
                        <div class="image-badge">Placement Ready 🚀</div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="hero-strip">
        <div class="container-custom">
            <div class="strip-box reveal">
                <div class="strip-grid">
                    <div class="strip-item">
                        <h3>Courses Style</h3>
                        <p>Homepage designed like learning and internship platforms.</p>
                    </div>
                    <div class="strip-item">
                        <h3>Placement Focus</h3>
                        <p>Specially built for final-year student preparation journey.</p>
                    </div>
                    <div class="strip-item">
                        <h3>Practice + Tests</h3>
                        <p>One place to prepare, attempt, track, and improve.</p>
                    </div>
                    <div class="strip-item">
                        <h3>Career Growth</h3>
                        <p>Looks more useful, modern, and purpose-driven.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container-custom">
            <h2 class="section-title reveal">Explore Preparation Areas</h2>
            <p class="section-subtitle reveal">
                Structured like a student learning platform so users feel they are entering a real training and placement preparation website.
            </p>

            <div class="cards-grid-3">
                <div class="course-card reveal">
                    <span class="course-badge">Popular Module</span>
                    <h3>Aptitude Training</h3>
                    <p>Prepare quantitative aptitude topics through guided question practice and strengthen your basics for company tests.</p>
                </div>

                <div class="course-card reveal">
                    <span class="course-badge">Career Skill</span>
                    <h3>Reasoning & Logic</h3>
                    <p>Improve analytical thinking and problem-solving skills required in screening rounds and assessment tests.</p>
                </div>

                <div class="course-card reveal">
                    <span class="course-badge">Placement Ready</span>
                    <h3>Technical Preparation</h3>
                    <p>Practice technical questions and concept-based evaluation to improve confidence for recruitment processes.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section placement-section">
        <div class="container-custom">
            <h2 class="section-title reveal">Why Students Will Like This Platform</h2>
            <p class="section-subtitle reveal">
                The homepage now feels more like a training, internships, and course platform instead of an AI dashboard.
            </p>

            <div class="placement-grid">
                <div class="placement-card reveal">
                    <div class="icon-box">🎓</div>
                    <h3>Student Friendly</h3>
                    <p>Simple, attractive, and easy to understand for students visiting the website for preparation.</p>
                </div>

                <div class="placement-card reveal">
                    <div class="icon-box">📚</div>
                    <h3>Learning Based</h3>
                    <p>Looks like a course and skill development platform where students can grow step by step.</p>
                </div>

                <div class="placement-card reveal">
                    <div class="icon-box">💼</div>
                    <h3>Placement Oriented</h3>
                    <p>Clearly shows the purpose of internship, placement, and career preparation in a professional way.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container-custom">
            <h2 class="section-title reveal">Core Features</h2>
            <p class="section-subtitle reveal">
                These modules make CareerPrep useful for practical placement preparation and strong enough for a final-year project.
            </p>

            <div class="cards-grid-4">
                <div class="feature-card reveal">
                    <div class="icon-box">📝</div>
                    <h3>MCQ Practice</h3>
                    <p>Topic-wise questions help students build confidence gradually and improve subject understanding.</p>
                </div>

                <div class="feature-card reveal">
                    <div class="icon-box">⏱️</div>
                    <h3>Mock Tests</h3>
                    <p>Timed tests simulate actual placement rounds and improve speed, focus, and confidence.</p>
                </div>

                <div class="feature-card reveal">
                    <div class="icon-box">📈</div>
                    <h3>Readiness Score</h3>
                    <p>Track preparation level and understand how close you are to becoming placement ready.</p>
                </div>

                <div class="feature-card reveal">
                    <div class="icon-box">🎯</div>
                    <h3>Skill Gap Analyzer</h3>
                    <p>Identify weak areas and focus on the topics that need more attention and practice.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="about">
        <div class="container-custom">
            <h2 class="section-title reveal">Our Platform</h2>
            <p class="section-subtitle reveal">
                A modern academic platform for students preparing for internships and campus placements.
            </p>

            <div class="about-showcase reveal">
                <div class="about-top">
                    <span>ABOUT THE PLATFORM</span>
                    <h3>A <span>Learning + Placement</span> Based Student Portal</h3>
                    <p>
                        CareerPrep is designed as a smart student platform that combines learning, question practice, mock testing, and performance analysis to help users prepare for internships and placement opportunities in an organized way.
                    </p>
                </div>

                <div class="about-points">
                    <div class="about-card reveal">
                        <h4>Modern Academic Feel</h4>
                        <p>The interface feels more like a real student learning portal and less like a plain technical dashboard.</p>
                    </div>

                    <div class="about-card reveal">
                        <h4>Useful Project Idea</h4>
                        <p>It presents your final-year project as practical, relevant, and connected to real career preparation needs.</p>
                    </div>

                    <div class="about-card reveal">
                        <h4>Professional Presentation</h4>
                        <p>The design helps your website look cleaner, stronger, and more meaningful during demo and evaluation.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container-custom">
            <h2 class="section-title reveal">How It Works</h2>
            <p class="section-subtitle reveal">
                A simple flow that makes the website feel like a structured learning and placement preparation system.
            </p>

            <div class="steps-grid">
                <div class="step-card reveal">
                    <div class="step-number">1</div>
                    <h3>Create Account</h3>
                    <p>Register and access the platform to begin your placement preparation journey.</p>
                </div>

                <div class="step-card reveal">
                    <div class="step-number">2</div>
                    <h3>Learn & Practice</h3>
                    <p>Work on topic-wise preparation like aptitude, reasoning, and technical concepts.</p>
                </div>

                <div class="step-card reveal">
                    <div class="step-number">3</div>
                    <h3>Take Mock Tests</h3>
                    <p>Test yourself through mock exams and improve confidence for real assessment rounds.</p>
                </div>

                <div class="step-card reveal">
                    <div class="step-number">4</div>
                    <h3>Improve Smartly</h3>
                    <p>Check your readiness score and weak areas to improve step by step.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container-custom">
            <div class="cta-box reveal">
                <h2>Start Building Your Placement Confidence</h2>
                <p>
                    Join a smarter student platform where learning, practice, and placement preparation come together in one professional academic experience.
                </p>

                <div class="hero-buttons" style="justify-content:center; margin-bottom:0;">
                    <a href="<?php echo $get_started_link; ?>" class="btn-main">Register Now</a>
                    <a href="<?php echo $practice_link; ?>" class="btn-outline">Explore Practice</a>
                </div>
            </div>
        </div>
    </section>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const reveals = document.querySelectorAll(".reveal");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show");
            }
        });
    }, {
        threshold: 0.12
    });

    reveals.forEach((el) => observer.observe(el));
});
</script>

<?php include 'includes/footer.php'; ?>
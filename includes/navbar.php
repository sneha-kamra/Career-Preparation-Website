<style>
    .main-navbar {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: linear-gradient(90deg, #0f172a, #1e293b);
        padding: 12px 0;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        font-family: 'Poppins', sans-serif;
    }

    .nav-container {
        max-width: 1200px;
        margin: auto;
        padding: 14px 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 60px;
    }

    .nav-logo {
        flex-shrink: 0;
    }

    .nav-logo a {
        text-decoration: none;
        font-size: 32px;
        font-weight: 800;
        color: #ffffff;
        white-space: nowrap;
        letter-spacing: 0.5px;
    }

    .nav-logo a span {
        background: linear-gradient(90deg, #38bdf8, #6366f1);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .nav-links {
        flex: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .nav-menu {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: nowrap;
        margin-left: 40px
    }

    .nav-auth {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }

    .nav-menu a,
    .dropdown-toggle {
        position: relative;
        text-decoration: none;
        color: #cbd5e1;
        font-size: 14px;
        font-weight: 500;
        padding: 10px 14px;
        border-radius: 10px;
        transition: all 0.3s ease;
        white-space: nowrap;
        background: transparent;
        border: none;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
    }

    .nav-menu a:hover,
    .dropdown-toggle:hover {
        color: #38bdf8;
        background: rgba(255, 255, 255, 0.08);
        transform: translateY(-2px);
    }

    .nav-menu a.active {
        background: linear-gradient(90deg, #2563eb, #4f46e5);
        color: #ffffff;
        box-shadow: 0 6px 18px rgba(37, 99, 235, 0.35);
    }

    .nav-menu a.active:hover {
        background: linear-gradient(90deg, #1d4ed8, #4338ca);
        color: #ffffff;
    }

    .dropdown {
        position: relative;
    }

    .dropdown-toggle {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .dropdown-toggle .arrow {
        font-size: 12px;
        transition: transform 0.3s ease;
    }

    .dropdown:hover .dropdown-toggle .arrow {
        transform: rotate(180deg);
    }

    .dropdown-menu {
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        min-width: 220px;
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.15);
        padding: 10px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.3s ease;
        z-index: 1001;
    }

    .dropdown:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-menu a {
        display: block;
        padding: 12px 14px;
        border-radius: 10px;
        color: #334155;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: 0.2s;
    }

    .dropdown-menu a:hover {
        background: #eff6ff;
        color: #2563eb;
        transform: none;
    }

    .dropdown-menu a.active {
        background: linear-gradient(90deg, #2563eb, #4f46e5);
        color: #ffffff;
    }

    .login-btn,
    .register-btn {
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        padding: 10px 18px;
        border-radius: 12px;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .login-btn {
        border: 1px solid #60a5fa;
        color: #ffffff;
        background: transparent;
    }

    .login-btn:hover {
        background: rgba(255, 255, 255, 0.10);
        transform: translateY(-2px);
    }

    .register-btn {
        background: #ffffff;
        color: #0f172a;
        border: 1px solid #ffffff;
    }

    .register-btn:hover {
        background: #f8fafc;
        transform: translateY(-2px);
    }

    @media (max-width: 992px) {
        .nav-container {
            flex-direction: column;
            align-items: flex-start;
        }

        .nav-links {
            width: 100%;
            flex-direction: column;
            align-items: flex-start;
            gap: 14px;
        }

        .nav-menu {
            width: 100%;
            overflow-x: auto;
            padding-bottom: 4px;
        }

        .nav-auth {
            width: 100%;
            justify-content: flex-start;
        }

        .dropdown-menu {
            right: auto;
            left: 0;
        }
    }

    @media (max-width: 576px) {
        .nav-logo a {
            font-size: 28px;
        }

        .login-btn,
        .register-btn {
            padding: 9px 14px;
            font-size: 13px;
        }
    }
</style>

<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>

<nav class="main-navbar">
    <div class="nav-container">
        <div class="nav-logo">
            <a href="index.php">Career<span>Prep</span></a>
        </div>

        <div class="nav-links">
            <div class="nav-menu">
                <a href="index.php" class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>">Home</a>
                <a href="index.php#about">About</a>
                <a href="practice.php" class="<?= ($currentPage == 'practice.php') ? 'active' : '' ?>">Practice</a>
                <a href="mock-test.php" class="<?= ($currentPage == 'mock-test.php') ? 'active' : '' ?>">Mock Test</a>
                <a href="contact.php" class="<?= ($currentPage == 'contact.php') ? 'active' : '' ?>">Contact</a>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button">
                        More <span class="arrow">▼</span>
                    </button>
                    <div class="dropdown-menu">
                        <a href="readiness-score.php" class="<?= ($currentPage == 'readiness-score.php') ? 'active' : '' ?>">Readiness Score</a>
                        <a href="skill-gap.php" class="<?= ($currentPage == 'skill-gap.php') ? 'active' : '' ?>">Skill Gap</a>
                    </div>
                </div>
            </div>

            <div class="nav-auth">
                <a href="login.php" class="login-btn">Login</a>
                <a href="register.php" class="register-btn">Register</a>
            </div>
        </div>
    </div>
</nav>
            <div id="NavbarContainer">
                <nav class="Navbar">
                    
                    <span class="logo" role="link" tabindex="0" onclick = "openPage('index.php')">
                        <img src="Assets/Images/Icons/logo.png" alt="" srcset="">
                    </span>

                    <div class="group">
                        <div class="navItem">
                            <span onclick = "openPage('search.php')" role="link" tabindex="0" class="navItemLink">Search
                                <img src="Assets/Images/Icons/search.png" alt="Search" class="icon">
                            </span>
                        </div>
                    </div>

                    <div class="group">
                        <div class="navItem">
                            <span onclick = "openPage('browser.php')" role="link" tabindex="0" class="navItemLink">Browse</span>
                        </div>
                        <div class="navItem">
                            <span onclick = "openPage('yourMusic.php')" role="link" tabindex="0" class="navItemLink">Your Music</span>
                        </div>
                        <div class="navItem">
                            <span onclick = "openPage('settings.php')" role="link" tabindex="0" class="navItemLink"><?php echo $userLoggedIn->getFirstAndLastName(); ?></span>
                        </div>
                    </div>

                </nav>
            </div>

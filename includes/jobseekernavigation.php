<?php
    if ((!isset($_SESSION['loggedin'])||($_SESSION['loggedin']!==true)) && ($_SESSION['user_role'] !== 'job_seeker')) {
    header("Location: ../index.php");
    exit;
    } 
?>
<ul>
        <li class="sidebardiv">
          <a <?php if ($active == "home") echo 'id="active"'; ?> href="home.php">
            <div>
              <img class="imagetoinvert"  src="graphic/homewhitesvg.svg" alt="">
              <p class="sidebarParagraph" > Home</p>
            </div>
          </a>
        </li>
        <li class="sidebardiv">
          <a <?php if ($active == "myprofile") echo 'id="active"'; ?> href="myprofile.php">
            <div>
              <img class="imagetoinvert"  src="graphic/profilesvg.svg" alt="">
              <p class="sidebarParagraph"> Profile</p>
            </div>
          </a>
        </li>
        <li class="sidebardiv">
          <a <?php if ($active == "applications") echo 'id="active"'; ?>  href="job-applications.php">
            <div>
              <img class="imagetoinvert"  src="graphic/userwhite.svg" alt="">
              <p class="sidebarParagraph"> Applications</p>
            </div>
          </a>
        </li>
        <li class="sidebardiv">
          <a <?php if ($active == "about") echo 'id="active"'; ?>  href="about.php">
            <div>
              <img class="imagetoinvert" src="graphic/aboutussvg.svg" alt="">
              <p class="sidebarParagraph"> About</p>
            </div>
          </a>
        </li>
        <li class="sidebardiv">
          <a <?php if ($active == "contactus") echo 'id="active"'; ?>  href="contact.php">
            <div>
              <img class="imagetoinvert" src="graphic/contactussvg.svg" alt="">
              <p class="sidebarParagraph">Contact</p>
            </div>
          </a>
        </li>
        <li class="sidebardiv">
          <a <?php if ($active == "policy") echo 'id="active"'; ?>  href="policy.php">
            <div>
              <img class="imagetoinvert" id="messageLogo" src="graphic/policywhitesvg.svg" alt="">
              <p class="sidebarParagraph"> Policy</p>
            </div>
          </a>
        </li>
      </ul>
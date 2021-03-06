<?php
  $norwegian = true;
  $lang_slug = "no";
  if($_GET["lang"] == "en") {
      $norwegian = false;
      $lang_slug = "en";
  }
  $data = file_get_contents('data.json');
  $data = json_decode($data, true);
  $skills = array_keys($data["skills"][$lang_slug]);
  $certifications = $data["certifications"][$lang_slug];
  $courses = $data["courses"][$lang_slug];

  if(substr( $data["website"], 0, 4 ) === "http") {
    $data["website_link"] = $data["website"];
  } else {
    $data["website_link"] = "http://" . $data["website"];
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <title>CV Kasper Rynning-Tønnesen</title>
    <link rel="stylesheet" href="style.css" />
    <meta charset="utf-8" />
    <script src="https://kit.fontawesome.com/6bad311157.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <script type="text/javascript">
      window.addEventListener("load", function(){
        document.getElementsByClassName("container-content")[0].style.opacity = 1;
      });
    </script>
    <script
      async
      src="https://www.googletagmanager.com/gtag/js?id=UA-46250211-1"
    ></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() {
        dataLayer.push(arguments);
      }
      gtag("js", new Date());

      gtag("config", "UA-46250211-1", {
        send_page_view: false,
      });

      <?php
        if($norwegian):
          ?>
          gtag('config', "UA-46250211-1", { 'page_path': '/cv/no' });
          <?php
        endif;
        if(!$norwegian):
          ?>
            gtag('config', "UA-46250211-1", { 'page_path': '/cv/en' });
          <?php
        endif;
      ?>
    </script>
  </head>
  <body style="<?php echo $data["background"]; ?>">
    <div class="container">
      <div class="container-content" style="opacity:1;">
        <div class="flex-container-for-print">
          <img class="me_picture print-picture" src="<?php echo $data["image"]; ?>">
          <div class="flex-container-inner-for-print">
            <header>
              <img class="me_picture desktop-picture" src="<?php echo $data["image"]; ?>">
              <span class="my_name"><?php echo $data["name"]; ?></span>
              <span class="position"><?php echo $data["position"]; ?></span>
            </header>
            <div class="way_contact">
              <div class="contact_top">
                <i class="fa fa-envelope-o" aria-hidden="true"></i><a class="mail padding10" href="mailto:<?php echo $data["email"]; ?>"><?php echo $data["email"]; ?></a>
                <i class="fa fa-phone" aria-hidden="true"></i><span class="phone padding10"><?php echo $data["phone"]; ?></span>
              </div>
              <div class="contact_bot">
                <i class="fa fa-globe" aria-hidden="true"></i><a class="homepage padding10" href="<?php echo $data["website_link"]; ?>"><?php echo $data["website"]; ?></a>
                <i class="fa fa-calendar-o" aria-hidden="true"></i><span class="born padding10"><?php echo $data["born"]; ?></span>
                <i class="fa fa-map-marker" aria-hidden="true"></i><span class="adress padding10"><?php echo $data["address"][$lang_slug]; ?></span>
              </div>
            </div>
          </div>
        </div>
        <div class="projects">
          <span class="small_header"><?php
            if($norwegian) {
                echo "Prosjekter";
            } else {
                echo "Projects";
            }
          ?></span>
          <?php foreach($data["projects"] as $projects): ?>
            <hr class="done_divider" />
            <div class="<?php echo $projects[$lang_slug]["slug"]; ?> projects-div">
              <p class="mini_header"><?php echo $projects[$lang_slug]["name"]; ?></p>
              <p class="mini_header_date"><?php echo $projects[$lang_slug]["when_where"]; ?></p>
              <p class="mini_header_title"><?php echo $projects[$lang_slug]["title"]; ?></p>
  	          <p class="intro"><?php echo $projects[$lang_slug]["description"]; ?></p>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="portfolio">
          <span class="small_header"><?php
            if($norwegian) {
                echo "Praksis";
            } else {
                echo "Work";
            }
          ?></span>
          <?php foreach($data["work"] as $work): ?>
            <hr class="done_divider" />
            <div class="<?php echo $work[$lang_slug]["slug"]; ?> portfolio-div">
              <p class="mini_header"><?php echo $work[$lang_slug]["name"]; ?></p>
              <p class="mini_header_date"><?php echo $work[$lang_slug]["when_where"]; ?></p>
              <p class="mini_header_title"><?php echo $work[$lang_slug]["title"]; ?></p>
  	          <p class="intro"><?php echo $work[$lang_slug]["description"]; ?></p>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="education">
          <span class="small_header"><?php
            if($norwegian) {
                echo "Utdanning";
            } else {
                echo "Education";
            }
          ?></span>
          <div class="education_flex">
            <?php foreach($data["education"] as $education): ?>
              <div class="<?php echo $education[$lang_slug]["slug"]; ?>">
                <p class="mini_header"><?php echo $education[$lang_slug]["title"]; ?></p>
                <p class="mini_header_where"><?php echo $education[$lang_slug]["where"]; ?></p>
                <p class="mini_header_date"><?php echo $education[$lang_slug]["when"]; ?></p>
                <?php if($education[$lang_slug]["grade"] != null): ?>
                  <p class="mini_header_grade"><?php echo $education[$lang_slug]["grade"]; ?></p>
                <?php endif; ?>
                <?php if($education[$lang_slug]["script"] != null): ?>
                    <script type="text/javascript"><?php echo $education[$lang_slug]["script"]; ?></script>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="courses_and_certifications">
          <?php if(count($certifications) > 0): ?>
            <p class="mini_header"><?php
            if($norwegian) {
              echo "Sertifiseringer";
            } else {
              echo "Certifications";
            }
            ?></p>
            <div class="certifications_list">
              <ul>
                <?php foreach($certifications as $certification): ?>
                    <li><?php echo $certification; ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>
          <br />
          <?php if(count($courses) > 0): ?>
            <p class="mini_header"><?php
            if($norwegian) {
              echo "Kurs";
            } else {
              echo "Courses";
            }
            ?></b>
            <div class="courses_list">
              <ul>
                <?php foreach($courses as $course): ?>
                    <li><?php echo $course; ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>
        </div>
        <div class="skills">
          <span class="small_header"><?php
            if($norwegian) {
                echo "Ferdigheter";
            } else {
                echo "Skills";
            }
          ?></span>
          <div class="skill_list">
            <?php foreach($skills as $skill): ?>
              <p class="mini_header"><?php echo $skill; ?></p>
              <ul>
                <?php foreach($data["skills"][$lang_slug][$skill] as $description): ?>
                  <li><?php echo $description; ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="referanser">
          <span class="small_header"><?php
            if($norwegian) {
              echo "Referanser";
            } else {
              echo "References";
            }
          ?></span>
          <div class="referanser_flex">
            Oppgis ved forespørsel
          </div>
          <a href="javascript:window.print()" class="print"><?php
            if($norwegian) {
              echo "Last ned som PDF";
            } else {
              echo "Save as PDF or print";
            }
          ?></a>
        </div>
        <a href="/data.json" id="language-setting" class="json-language">JSON</a>
        <a href="?lang=<?php
          if($norwegian) {
            echo "en";
          } else {
            echo "no";
          }
        ?>" id="language-setting"><?php
          if($norwegian) {
            echo "English";
          } else {
            echo "Norsk";
          }
        ?></a>
      </div>
    </div>
  </body>
</html>

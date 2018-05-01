<?php
  $data = file_get_contents('data.json');
  $data = json_decode($data, true);
  $skills = array_keys($data["skills"]);

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
    <link rel="stylesheet" href="font-awesome-4.6.3/css/font-awesome.min.css">
    <script type="text/javascript">
      window.addEventListener("load", function(){
        document.getElementsByClassName("container-content")[0].style.opacity = 1;
      });
    </script>
  </head>
  <body style="<?php echo $data["background"]; ?>">
    <div class="container">
      <div class="container-content">
        <header>
          <div class="me_picture" style="background: url('<?php echo $data["image"]; ?>') no-repeat;"></div>
          <span class="my_name"><?php echo $data["name"]; ?></span>

        </header>
        <div class="way_contact">
          <div class="contact_top">
            <i class="fa fa-envelope-o" aria-hidden="true"></i><a class="mail padding10" href="mailto:<?php echo $data["email"]; ?>"><?php echo $data["email"]; ?></a>
            <i class="fa fa-phone" aria-hidden="true"></i><span class="phone padding10"><?php echo $data["phone"]; ?></span>
            <i class="fa fa-globe" aria-hidden="true"></i><a class="homepage padding10" href="<?php echo $data["website_link"]; ?>"><?php echo $data["website"]; ?></a>
          </div>
          <div class="contact_bot">
            <i class="fa fa-calendar-o" aria-hidden="true"></i><span class="born padding10"><?php echo $data["born"]; ?></span>
            <i class="fa fa-map-marker" aria-hidden="true"></i><span class="adress padding10"><?php echo $data["address"]; ?></span>
          </div>
        </div>
        <div class="portfolio">
          <span class="small_header">Praksis</span>
          <?php foreach($data["work"] as $work): ?>
            <hr class="done_divider" />
            <div class="<?php echo $work["slug"]; ?> portfolio-div">
              <p class="mini_header"><?php echo $work["name"]; ?></p>
              <p class="mini_header_date"><?php echo $work["when_where"]; ?></p>
              <p class="mini_header_title"><?php echo $work["title"]; ?></p>
  	          <p class="intro"><?php echo $work["description"]; ?></p>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="education">
          <span class="small_header">Utdanning</span>
          <div class="education_flex">
            <?php foreach($data["education"] as $education): ?>
              <div class="<?php echo $education["slug"]; ?>">
                <p class="mini_header"><?php echo $education["title"]; ?></p>
                <p class="mini_header_where"><?php echo $education["where"]; ?></p>
                <p class="mini_header_date"><?php echo $education["when"]; ?></p>
                <?php if($education["grade"] != null): ?>
                  <p class="mini_header_grade"><?php echo $education["grade"]; ?></p>
                <?php endif; ?>
                <?php if($education["script"] != null): ?>
                    <script type="text/javascript"><?php echo $education["script"]; ?></script>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="skills">
          <span class="small_header">Ferdigheter</span>
          <div class="skill_list">
            <?php foreach($skills as $skill): ?>
              <p class="mini_header"><?php echo $skill; ?></p>
              <ul>
                <?php foreach($data["skills"][$skill] as $description): ?>
                  <li><?php echo $description; ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="referanser">
          <span class="small_header">Referanser</span>
          <div class="referanser_flex">
            <?php foreach($data["references"] as $ref): ?>
              <div class="<?php echo $ref["slug"]; ?>">
                <p class="mini_header"><?php echo $ref["name"]; ?></p>
                <p class="mini_header_date"><?php echo $ref["email"]; ?></p>
              </div>
            <?php endforeach; ?>
          </div>
          <a href="javascript:window.print()" class="print">Last ned som PDF</a>
        </div>
      </div>
    </div>
  </body>
</html>

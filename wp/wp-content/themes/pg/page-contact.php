<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <div class="l-block-group">
    <div class="l-block--one">
      <div class="o-dotlist-wrap">
        <?php the_content(); ?>
      </div>
      <?php
        $buttons = simple_fields_fieldgroup("sf_button");
        foreach ($buttons as $button) {
          if ($button[sf_button__position][selected_value] == "Left") {
            echo "<a class='o-button' href='" . $button[sf_button__link] . "'>" . $button[sf_button__title] . "</a>";
            echo "<br>";
          }
        }
      ?>
    </div>
    <div class="l-block--one">
      <?php
        $more_textarea = simple_fields_value("sf_textarea__item");
        if ($more_textarea) {
          echo "<div class='o-dotlist-wrap'>";
          echo $more_textarea;
          echo "</div>";
        }

        $buttons = simple_fields_fieldgroup("sf_button");
        foreach ($buttons as $button) {
          if ($button[sf_button__position][selected_value] == "Right") {
            echo "<a class='o-button' href='" . $button[sf_button__link] . "'>" . $button[sf_button__title] . "</a>";
            echo "<br>";
          }
        }
      ?>
    </div>
  </div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
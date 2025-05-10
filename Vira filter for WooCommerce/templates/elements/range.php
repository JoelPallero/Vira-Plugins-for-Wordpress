<div class="vira-filter-item range">
  <label><?php echo esc_html($title); ?></label>
  <input type="range" name="<?php echo esc_attr($key); ?>_min" min="<?php echo esc_attr($min); ?>" max="<?php echo esc_attr($max); ?>">
  <input type="range" name="<?php echo esc_attr($key); ?>_max" min="<?php echo esc_attr($min); ?>" max="<?php echo esc_attr($max); ?>">
</div>

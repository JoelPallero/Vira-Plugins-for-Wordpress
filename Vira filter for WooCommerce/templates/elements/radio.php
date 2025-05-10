<div class="vira-filter-item radio">
  <label><?php echo esc_html($title); ?></label>
  <?php foreach ($options as $val => $label): ?>
    <label><input type="radio" name="<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($val); ?>"> <?php echo esc_html($label); ?></label>
  <?php endforeach; ?>
</div>
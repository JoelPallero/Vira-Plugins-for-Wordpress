<div class="vira-filter-item select">
  <label><?php echo esc_html($title); ?></label>
  <select name="<?php echo esc_attr($key); ?>">
    <option value="">--</option>
    <?php foreach ($options as $val => $label): ?>
      <option value="<?php echo esc_attr($val); ?>"><?php echo esc_html($label); ?></option>
    <?php endforeach; ?>
  </select>
</div>
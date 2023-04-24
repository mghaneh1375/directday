UPDATE wp_options SET option_value = replace(option_value, 'http://math.echeck.ir', 'https://directday.com') WHERE option_name = 'home' OR option_name = 'siteurl';
UPDATE wp_posts SET guid = replace(guid, 'http://math.echeck.ir', 'https://directday.com');
UPDATE wp_posts SET post_content = replace(post_content, 'http://math.echeck.ir', 'https://directday.com'); 
UPDATE wp_postmeta SET meta_value = replace(meta_value, 'http://math.echeck.ir', 'https://directday.com');



UPDATE wp_options SET option_value = replace(option_value, 'http://localhost/directday', 'https://directday.com') WHERE option_name = 'home' OR option_name = 'siteurl';
UPDATE wp_posts SET guid = replace(guid, 'http://localhost/directday','https://directday.com');
UPDATE wp_posts SET post_content = replace(post_content, 'http://localhost/directday', 'https://directday.com'); 
UPDATE wp_postmeta SET meta_value = replace(meta_value,'http://localhost/directday','https://directday.com');

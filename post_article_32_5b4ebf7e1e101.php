<?php
include('wp-load.php');
require_once(ABSPATH .'/wp-admin/includes/taxonomy.php');
require_once(ABSPATH .'/wp-includes/post.php');
require_once(ABSPATH .'/wp-includes/link-template.php');
require_once(ABSPATH .'/wp-admin/includes/image.php');
$cat_id = get_category_by_slug('product-reviews')->term_id;
  //echo 'cat_id is: '.$cat_id;
$my_post = array(
  'post_title'    => wp_strip_all_tags('PetAmi Premium Waterproof Soft Sherpa Pet Blanket Review'),
  'post_content'  => '<div><div>
            <div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center azon-review-image"><br>
                     <a rel="nofollow" target="_blank" class="re_track_btn" href="https://www.amazon.com/PetAmi-Waterproof-Comfortable-Lightweight-Microfiber/dp/B075GWFHHJ?tag=hardcoreprofi-20">
                        <img src="https://images-na.ssl-images-amazon.com/images/I/51B7Nhx0YoL.jpg?tag=hardcoreprofi-20">
                    </a>


                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 review-title-section">
                     <div class="review-title" style="text-align:left"><h2>
                        <a rel="nofollow" target="_blank" class="re_track_btn" href="https://www.amazon.com/PetAmi-Waterproof-Comfortable-Lightweight-Microfiber/dp/B075GWFHHJ?tag=hardcoreprofi-20">
                          PetAmi Premium Waterproof Soft Sherpa Pet Blanket by Cozy, Comfortable, Plush, Lightweight Microfiber, 100% WATERPROOF (30" x 40", Gray/Gray Sherpa)
                        </a>
                    </h2></div>
                    <div class="review-price">
                     Amazon Price: $17.99
                    </div>
                    <div>
                        <div>
                            <div>
                                <a class="buy_item_button review-button" href="https://www.amazon.com/PetAmi-Waterproof-Comfortable-Lightweight-Microfiber/dp/B075GWFHHJ?tag=hardcoreprofi-20" target="_blank" rel="nofollow">
                                    Buy It Now On Amazon                         </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="review-features">
                <h4>Features</h4>
                <div>
                    <ul class="featured_list"><li>Perfect for your pet to lounge and nap on your sofa; Great for indoor use but also suitable for outdoor use; Measures 30 x 40 inches or 50 x 40 inches.</li><li>100% WATERPROOF -- Protects your furniture from spills and urine while keeping your pet cozy and comfortable.</li><li>WARM AND COMFORTABLE - Equipped with warm sherpa lining on the other side. The blanket is made with super soft plush fabric that will keep your pets warm and cozy while they sleeps comfortably on your sofa.</li><li>VERSATILE - Can be used indoors on the sofa, bed, or floor, outdoors at the park or beach, or inside the car during a long road trip.</li><li>HIGH QUALITY AND DURABLE CONSTRUCTION - Made with 460 GSM of 100% premium microfiber polyester, this blanket is soft, lightweight, yet durable.</li></ul>
                </div>
            </div>
        </div><p>The&nbsp;<b>PetAmi Premium Waterproof Soft Sherpa Pet Blanket</b>&nbsp;is an ideal choice for your pet to lounge on and even have a nap on your sofa or on the floor without having to freeze from the cold. It is great for indoor use as well as using in the outdoors when you are on a picnic.<br></p><p>A very comfortable blanket, your pet will find it really entertaining as well as cozy to just lie in there and stay away from the cold. The pet blanket is also completely waterproof and made from high-quality materials which means that your furniture stays protected from urine and spills.</p><p>This maintains the levels and standards of cleanliness in your home and you won’t need to be worried about doing multiple rounds of washing in or around your home as a result of the pet leaving a mess. Instead, the waterproof pet blanket keeps a cover around the pet so you have fewer items to wash.</p><p>This blanket is also really warm and also comfortable as it comes equipped with a warm sherpa lining on the other side whereas the blanket, made from extremely soft plush fabric will keep your pets warm and cozy as they are sleeping in the comfort of your sofa.</p><p>This is a very useful pet blanket to keep around and it can be used anywhere so do not worry about bringing it along with you on road trips or when going to the beach. You can simply have it packed with the rest of your items and while you are on the go, your pet can relax cozily on the blanket and not have to soil your seats as you move about in the countryside.</p><p>The very design and construction of the&nbsp;<b>PetAmi Premium Waterproof Soft Sherpa Pet Blanket</b>&nbsp;are of very high quality and of a durable material which implies that it is made with the best microfiber polyester and is soft, durable and very lightweight.</p><p>Pet owners usually get concerned about the health of their little puppies especially when it is the cold season and they need to maintain their health. With a waterproof and soft blanket to keep them covered and protected from the elements of the weather, there is not a need to worry about anything yourself.</p><p>You and your pet will create more loving memories when you have placed at their disposal all the comforts and pleasures they might need. The warmth rendered by this blanket is also precious in a way the pet will not fall ill very easily or become allergic to its surroundings.</p><p>Our waterproof pet blankets have been made from refined materials that are the best in the industry and will truly see to it that your needs have been met. We place our efforts in giving you a wide variety of blanket colors to choose from as well as varying material quality hence there’s no worry of your pet reacting differently to a color they have not been accustomed to yet.</p><p>In short, there is plenty to choose from and you are guaranteed of the best quality.</p><center><p><a href="https://www.amazon.com/PetAmi-Waterproof-Comfortable-Lightweight-Microfiber/dp/B075GWFHHJ?tag=hardcoreprofi-20#customerReviews" target="_blank"><div class="amazon"><button class="btn-azon"><i class="fa fa-amazon" style="font-size:90px;float: left;"></i>Click Here To See What Customers Are Saying</button></div></a></p></center>',
  'post_status'   => 'publish',
  'post_author'   => 1,
  'post_type'      => 'post',
  'post_date'         => '2018-07-18 04:18:03',
  'post_category' => array( $cat_id )
);
 $pid = wp_insert_post( $my_post );
 if($pid != 0){

 echo get_post_permalink($pid,true,false);
 }
//unlink('post_article.php');

?>
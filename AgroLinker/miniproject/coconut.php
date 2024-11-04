<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!--bootstrap navigation connection-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!---font awesome-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons@3.5.0/css/flag-icons.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!---footer css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    

    <style>
.product__container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 15px; /* Reduce the gap */
    padding: 20px;
    margin-top: 190px;
    max-width: 1200px; /* Limit the width to control spacing */
    margin-left: auto; /* Center the container */
    margin-right: auto;
    
}
.product__item {
    background: #fff;
    border: 1px solid #eaeaea;
    border-radius: 10px;
    overflow: hidden;
    transition: box-shadow 0.3s ease;
    position: relative;
    width: 550px; /* Set a fixed width */
    max-width: 100%; /* Ensure it fits within the container */
    height: auto; /* Adjust height accordingly */
    margin-bottom: 50px;
   
}

.product__item:hover {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.product__banner {
    position: relative;
    overflow: hidden;
}

.product__img {
    width: 100%;
    height: 200px; /* Control image height */
    object-fit: cover; /* Ensure images are properly cropped */
}

.product__img {
    width: 100%;
    height: auto;
    display: block;
    transition: opacity 0.3s ease;
}

.product__img.hover {
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
}

.product__banner:hover .product__img.hover {
    opacity: 1;
}

.product__actions {
    position: absolute;
    top: 10px;
    right: 10px;
    display: flex;
    flex-direction: column;
    gap: 5px;
}



.action__btn {
    text-decoration: none; /* Remove underline */
    color: #000; /* Change text color */
    background-color: #f0f0f0; /* Button background color */
    padding: 5px 10px; /* Add some padding */
    border-radius: 5px; /* Rounded corners */
    transition: background-color 0.3s; /* Smooth background transition */
}

.action__btn:hover {
    background-color: #e0e0e0; /* Change background color on hover */
}

.product__badge {
    position: absolute;
    top: 10px;
    left: 10px;
    /*background: #ff6b6b;*/
    color: #fff;
    padding: 5px 10px;
    font-size: 12px;
    border-radius: 20px;
}

.product__content {
    padding: 15px;
    text-align: center;
}

.product__category {
    font-size: 14px;
    color: #888;
    display: block;
    margin-bottom: 5px;
}

.product__title {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
    transition: color 0.3s ease;
}

.product__title:hover {
    color: #cfed94;
}

.product__rating {
    margin-bottom: 10px;
    color: #FFD700;
}

.product__price {
    font-size: 16px;
    margin-bottom: 15px;
}

.new__price {
    font-weight: bold;
    color: #333;
}

.old__price {
    text-decoration: line-through;
    color: #888;
    margin-left: 5px;
}

.cart__btn {
    display: inline-block;
    background: #865dad;
    color: #fff;
    padding: 8px 15px;
    border-radius: 20px;
    transition:0.3s ease;
    font-size: 16px;
}

.cart__btn:hover {
    background: #c7b3cc;
}

.breadcrumb {
    background-color: #d9e3ee; 
    padding: 10px 20px; 
    border-radius: 5px; 
    margin: 20px 0; 
    margin-top: 150px;
    margin-bottom: -150px;
}

.breadcrumb__list {
    list-style: none;
    display: flex; 
    align-items: center;
    font-size: 16px; 
    color: #333; 
}

.breadcrumb__link {
    text-decoration: none; 
    color: #0c243d; 
   transition: color 0.3s; 
   font-size: 1.2rem;
   
}

.breadcrumb__link:hover {
    color: #0056b3; 
}

.breadcrumb__separator {
    margin: 0 5px; 
    color: #999; 
}

.breadcrumb__current {
    font-weight: bold; 
    color: #333; 
}

  
    </style>
</head>
<body>


<!----navbar---->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="margin-top: 30px;margin-left: 30px;margin-right:30px; border-radius: 20px;padding-top: 10px;padding-bottom: 10px;">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">AgroLinker</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">AgroLinker</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="font-size:15px;">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.html" style="margin-left: 350px;">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html">About us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Products.html">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="page.php">Career</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cartpage.html">Add to cart</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>


 <!-- Breadcrumb Section -->
<section class="breadcrumb">
    <ul class="breadcrumb__list flex container">
        <li><a href="Products.html" class="breadcrumb__link">Home</a></li>
        <li><span class="breadcrumb__link">></span></li>
        <li><span class="breadcrumb__link">Products</span></li>
    </ul>
</section>


  <!---product -->
    <div class="product__container grid">
        <!-- Product 1 -->
        <div class="product__item">
            <div class="product__banner">
                <a href="#" class="product__images">
                    <img src="assests/Coco-sugar.png" alt="Jute Hat" class="product__img default"/>
                    <img src="assests/coco-sugar2.jpg" alt="Jute Hat Hover" class="product__img hover"/>
                </a>
                <div class="product__actions">
                    <a href="coco1.html" class="action__btn" aria-label="Quick View">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="#" class="action__btn" aria-label="Add to Wishlist">
                        <i class="fas fa-heart"></i>
                    </a>
                    <a href="#" class="action__btn" aria-label="Compare">
                        <i class="fas fa-random"></i>
                    </a>
                </div>
                
            </div>
            <div class="product__content">
                <span class="product__category">COCONUT SUGAR</span>
                <a href="#">
                    <h3 class="product__title">Healthier Sweetening</h3>
                </a>
                <div class="product__rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="product__price flex">
                    <span class="new__price">INR 500</span>
                    <span class="old__price">INR 450</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                    <i class="fa-solid fa-cart-shopping"> </i>Add to cart
                </a>
            </div>
        </div>
    
        <!-- Product 2 -->
        <div class="product__item">
            <div class="product__banner">
                <a href="#" class="product__images">
                    <img src="assests/coco-vinegar.png" alt="Cotton Bag" class="product__img default"/>
                    <img src="assests/coco-vinegar2.jpg" alt="Cotton Bag Hover" class="product__img hover"/>
                </a>
                <div class="product__actions">
                    <a href="coco2.html" class="action__btn" aria-label="Quick View">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="#" class="action__btn" aria-label="Add to Wishlist">
                        <i class="fas fa-heart"></i>
                    </a>
                    <a href="#" class="action__btn" aria-label="Compare">
                        <i class="fas fa-random"></i>
                    </a>
                </div>
                
            </div>
            <div class="product__content">
                <span class="product__category">COCONUT VINEGAR</span>
                <a href="#">
                    <h3 class="product__title">Flavorful Dishes</h3>
                </a>
                <div class="product__rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="product__price flex">
                    <span class="new__price">INR 600</span>
                    <span class="old__price">INR 550</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                    <i class="fa-solid fa-cart-shopping"> </i>Add to cart
                </a>
            </div>
        </div>
    
        <!-- Product 3 -->
        <div class="product__item">
            <div class="product__banner">
                <a href="#" class="product__images">
                    <img src="assests/coco-water.png" alt="Recycled Bottle" class="product__img default"/>
                    <img src="assests/coco-water2.jpg" alt="Recycled Bottle Hover" class="product__img hover"/>
                </a>
                <div class="product__actions">
                    <a href="coco3.html" class="action__btn" aria-label="Quick View">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="#" class="action__btn" aria-label="Add to Wishlist">
                        <i class="fas fa-heart"></i>
                    </a>
                    <a href="#" class="action__btn" aria-label="Compare">
                        <i class="fas fa-random"></i>
                    </a>
                </div>
                
            </div>
            <div class="product__content">
                <span class="product__category">COCONUT WATER</span>
                <a href="#">
                    <h3 class="product__title">Refreshing Coconut Water Beverage</h3>
                </a>
                <div class="product__rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="product__price flex">
                    <span class="new__price">INR 500</span>
                    <span class="old__price">INR 750</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                    <i class="fa-solid fa-cart-shopping"> </i>Add to cart
                </a>
            </div>
        </div>
     <!---PRODUCT 4-->
        <div class="product__item">
            <div class="product__banner">
                <a href="#" class="product__images">
                    <img src="assests/coco-husk.jpg" alt="Recycled Bottle" class="product__img default"/>
                    <img src="assests/coco-husk2.jpg" alt="Recycled Bottle Hover" class="product__img hover"/>
                </a>
                <div class="product__actions">
                    <a href="coco4.html" class="action__btn" aria-label="Quick View">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="#" class="action__btn" aria-label="Add to Wishlist">
                        <i class="fas fa-heart"></i>
                    </a>
                    <a href="#" class="action__btn" aria-label="Compare">
                        <i class="fas fa-random"></i>
                    </a>
                </div>
                
            </div>
            <div class="product__content">
                <span class="product__category">COCONUT HUSK</span>
                <a href="#">
                    <h3 class="product__title">Eco-Friendly Coconut Husk Products</h3>
                </a>
                <div class="product__rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="product__price flex">
                    <span class="new__price">INR 400</span>
                    <span class="old__price">INR 550</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                    <i class="fa-solid fa-cart-shopping"> </i>Add to cart
                </a>
            </div>
        </div>
        <!---PRODUCT 5-->
        <div class="product__item">
            <div class="product__banner">
                <a href="#" class="product__images">
                    <img src="assests/coco-oil.jpg" alt="Recycled Bottle" class="product__img default"/>
                    <img src="assests/coco-oil2.jpg" alt="Recycled Bottle Hover" class="product__img hover"/>
                </a>
                <div class="product__actions">
                    <a href="coco5.html" class="action__btn" aria-label="Quick View">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="#" class="action__btn" aria-label="Add to Wishlist">
                        <i class="fas fa-heart"></i>
                    </a>
                    <a href="#" class="action__btn" aria-label="Compare">
                        <i class="fas fa-random"></i>
                    </a>
                </div>
                
            </div>
            <div class="product__content">
                <span class="product__category">COCONUT OIL</span>
                <a href="#">
                    <h3 class="product__title">Versatile Coconut Oil for Cooking & Skincare</h3>
                </a>
                <div class="product__rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="product__price flex">
                    <span class="new__price">INR 500</span>
                    <span class="old__price">INR 800</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                    <i class="fa-solid fa-cart-shopping"> </i>Add to cart
                </a>
            </div>
        </div>
        <!---product 6-->
        <div class="product__item">
            <div class="product__banner">
                <a href="#" class="product__images">
                    <img src="assests/coco-flour2.jpg" alt="Recycled Bottle" class="product__img default"/>
                    <img src="assests/coco-flour.png" alt="Recycled Bottle Hover" class="product__img hover"/>
                </a>
                <div class="product__actions">
                    <a href="coco6.html" class="action__btn" aria-label="Quick View">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="#" class="action__btn" aria-label="Add to Wishlist">
                        <i class="fas fa-heart"></i>
                    </a>
                    <a href="#" class="action__btn" aria-label="Compare">
                        <i class="fas fa-random"></i>
                    </a>
                </div>
                
            </div>
            <div class="product__content">
                <span class="product__category">COCONUT FLOUR </span>
                <a href="#">
                    <h3 class="product__title">Gluten-Free</h3>
                </a>
                <div class="product__rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="product__price flex">
                    <span class="new__price">INR 400</span>
                    <span class="old__price">INR 850</span>
                </div>
                <a href="#" class="action__btn cart__btn" aria-label="Add To Cart">
                    <i class="fa-solid fa-cart-shopping"> </i>Add to cart
                </a>
            </div>
        </div>
        
        



        <script>
            document.querySelectorAll('.cart__btn').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        
        const productItem = this.closest('.product__item');
        const productTitle = productItem.querySelector('.product__category').innerText;
        const productPrice = productItem.querySelector('.new__price').innerText.replace('INR ', '');
        const productImage = productItem.querySelector('.product__img.default').src;

        if (!productTitle || !productPrice || !productImage) {
            console.error("Could not find product information.");
            return;
        }

        // Encode the data to handle special characters and spaces
        fetch('add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product=${encodeURIComponent(productTitle)}&price=${encodeURIComponent(productPrice)}&image=${encodeURIComponent(productImage)}`
        }).then(response => response.json())
          .then(data => {
              if(data.success) {
                  alert("Product added to cart successfully!");
                  window.location.href = 'cartpage.html'; 
              } else {
                  console.log("Error:", data.error); // Display error
                  alert("Failed to add product to cart.");
              }
          })
          .catch(error => console.log("Network Error:", error));
    });
});
</script>
            
            
            



  


     <!---bootstrap js-->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    </body>
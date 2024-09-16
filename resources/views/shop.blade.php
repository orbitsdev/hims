<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Display Layout</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    * {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
  padding: 20px;
}

.container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
}

.product-card {
  background-color: white;
  border: 1px solid #e0e0e0;
  border-radius: 10px;
  padding: 15px;
  text-align: center;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease;
}

.product-card:hover {
  transform: translateY(-5px);
}

.product-card img {
  max-width: 100%;
  height: auto;
  border-radius: 8px;
}

h3 {
  margin: 15px 0 10px 0;
  font-size: 18px;
  color: #333;
}

.price {
  font-size: 16px;
  color: #EFAF33; /* Avante Foods primary color */
}

.rating {
  font-size: 14px;
  color: #777;
  margin-bottom: 10px;
}

.add-to-cart {
  background-color: #EB9B00; /* Avante Foods dark primary color */
  color: white;
  border: none;
  padding: 10px 15px;
  font-size: 14px;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.add-to-cart:hover {
  background-color: #FFA500; /* Lighter orange for hover */
}

  </style>
</head>
<body>

  <div class="container">
    <div class="product-card">
      <img src="https://via.placeholder.com/150" alt="Product Image">
      <h3>Apple</h3>
      <p class="price">$2.99</p>
      <p class="rating">Rating: 4.5/5</p>
      <button class="add-to-cart">Add to Cart</button>
    </div>

    <div class="product-card">
      <img src="https://via.placeholder.com/150" alt="Product Image">
      <h3>Banana</h3>
      <p class="price">$1.99</p>
      <p class="rating">Rating: 4.7/5</p>
      <button class="add-to-cart">Add to Cart</button>
    </div>

    <!-- Add more products here -->
    
  </div>

</body>
</html>

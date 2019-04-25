# Gousto REST API Service
Service created using Laravel which implements a set of API operations for the recipe management.

### Step 1 - To install the API
Modify the .env to set the right path for the DB_DATABASE

In terminal run
```
php artisan migrate:fresh
php artisan serve
```

Use Postman to test the various API

Import the test data
```
GET - http://localhost:8000/api/recipes/import
```

Fetch a recipe by id
```
GET - http://localhost:8000/api/recipes/3
```

Fetch all the recipes for a specific cuisine (should paginate)
```
GET - http://localhost:8000/api/recipes/cuisines/british (displays 5 records)
```

Rate an existing recipe between 1 and 5
```
POST - http://localhost:8000/api/reciperatings?recipe_id=2&email=george@bu&comments=test&ratings=4
```

Update an existing recipe
```
PUT - http://localhost:8000/api/recipes/9?short_title=GrilledFish
```

Store a new recipe
```
POST - http://localhost:8000/api/recipes/?box_type=vegetarian&title=Sweets Chilli and Lime Pork on a Crunchy Fresh Noodle Salad&slug=sweet-chilli-and-lime-pork-on-a-crunchy-fresh-noodle-salad&short_title=&marketing=Here we've used onglet steak which is an extra flavoursome cut of beef that should never be cooked past medium rare. So if you're a fan of well done steak, this one may not be for you. However, if you love rare steak and fancy trying a new cut, please be&calories_kcal=401&protein_grams=12&fat_grams=35&bulletpoint1=&bulletpoint2=&bulletpoint3=&recipe_diet_type_id=meat&season=all&base=noodles&protein_source=pork&preparation_time_minutes=35&shelf_life_days=4&equipment_needed=Appetite&origin_country=Great Britain&recipe_cuisine=asian&in_your_box=&gousto_reference=0
```

### Step 2 - Testing of the API
Adjust config/database to set 'database' => ':memory:'

Run in terminal
```
  php artisan migrate
  composer test
```

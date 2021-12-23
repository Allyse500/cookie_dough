CREATE TABLE publicRecipes (

publicRecipeID INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
publicRecipesUserID INT(11) NOT NULL,
publicRecipesUserName VARCHAR(255) NOT NULL,
publicRecipesTitle VARCHAR(255) NOT NULL,
publicRecipesIngredients TEXT NOT NULL,
publicRecipesPreparation TEXT NOT NULL,
public VARCHAR(10)

);
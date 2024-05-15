package main

import (
	"ABOUTUS-SERVICE/config"
	"ABOUTUS-SERVICE/controllers"
	"ABOUTUS-SERVICE/models"
	"ABOUTUS-SERVICE/repositories"
	"ABOUTUS-SERVICE/router"
	"ABOUTUS-SERVICE/services"
	"log"
	"net/http"
	"os"

	"github.com/joho/godotenv"
)

func main() {
	// Load environment variables from .env file
	err := godotenv.Load()
	if err != nil {
		log.Fatalf("Error loading .env file")
	}

	// Connect to the database
	config.ConnectDatabase()

	// Migrate the schema
	config.DB.AutoMigrate(&models.AboutUs{})

	// Setup repositories, services, and controllers
	aboutUsRepository := repositories.NewAboutUsRepository(config.DB)
	aboutUsService := services.NewAboutUsService(aboutUsRepository)
	aboutUsController := controllers.NewAboutUsController(aboutUsService)

	// Setup the router
	r := router.InitializeRouter(aboutUsController)

	// Start the server
	port := os.Getenv("PORT")
	if port == "" {
		port = "9007"
	}
	log.Printf("Server running on port %s", port)
	log.Fatal(http.ListenAndServe(":"+port, r))
}

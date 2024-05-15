package routes

import (
	"REVIEW-SERVICE/controllers"

	"github.com/gin-gonic/gin"
)

func SetupRouter() *gin.Engine {
	r := gin.Default()

	// Define the review routes
	r.GET("/reviews", controllers.FindReviews)
	r.POST("/reviews", controllers.CreateReview)
	r.GET("/reviews/:id", controllers.FindReview)
	r.PUT("/reviews/:id", controllers.UpdateReview)
	r.DELETE("/reviews/:id", controllers.DeleteReview)

	return r
}

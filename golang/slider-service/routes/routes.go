package routes

import (
	"SLIDER-SERVICE/controllers"

	"github.com/gin-gonic/gin"
)
func SetupRouter() *gin.Engine {
	r := gin.Default()

	// Routes for CRUD operations
	r.GET("/sliders", controllers.GetAllSliders)
	r.GET("/sliders/:id", controllers.GetSlider)
	r.POST("/sliders", controllers.CreateSlider)
	r.PUT("/sliders/:id", controllers.UpdateSlider)
	r.DELETE("/sliders/:id", controllers.DeleteSlider)

	return r
}

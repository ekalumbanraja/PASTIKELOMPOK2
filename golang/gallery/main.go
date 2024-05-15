package main

import (
	"github.com/ekalumbanraja/golang_gin_gorm_JWT/config"
	"github.com/ekalumbanraja/golang_gin_gorm_JWT/controller"
	"github.com/ekalumbanraja/golang_gin_gorm_JWT/repository"
	"github.com/ekalumbanraja/golang_gin_gorm_JWT/service"
	"github.com/gin-gonic/gin"
	"gorm.io/gorm"
)

var (
	db                  *gorm.DB                     = config.SetupDatabaseConnection()
	galleryRepository   repository.GalleryRepository = repository.NewGalleryRepository(db)
	galleryService      service.GalleryService       = service.NewGalleryService(galleryRepository)
	galleryController   controller.GalleryController = controller.NewGalleryController(galleryService)
)

func main() {
	defer config.CloseDatabaseConnection(db)
	r := gin.Default()

	// Grouping gallery routes
	galleryRoutes := r.Group("/api/galleries")
	{
		galleryRoutes.GET("/", galleryController.All)
		galleryRoutes.POST("/", galleryController.Insert)
		galleryRoutes.GET("/:id", galleryController.FindByID)
		galleryRoutes.PUT("/:id", galleryController.Update)
		galleryRoutes.DELETE("/:id", galleryController.Delete)
	}

	r.Run(":9094")
}

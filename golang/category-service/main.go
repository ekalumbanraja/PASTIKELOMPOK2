package main

import (
	"github.com/ErlanggaWebdev/category-service/config"
	"github.com/ErlanggaWebdev/category-service/controller"
	"github.com/ErlanggaWebdev/category-service/repository"
	"github.com/ErlanggaWebdev/category-service/service"
	"github.com/gin-gonic/gin"
	"gorm.io/gorm"
)

var (
	db                 *gorm.DB                      = config.SetupDatabaseConnection()
	categoryRepository repository.CategoryRepository = repository.NewCategoryRepository(db)
	CategoryService    service.CategoryService       = service.NewCategoryService(categoryRepository)
	categoryController controller.CategoryController = controller.NewCategoryController(CategoryService)
)

// membuat variable db dengan nilai setup database connection
func main() {
	defer config.CloseDatabaseConnection(db)
	r := gin.Default()

	categoryRoutes := r.Group("/api/category")
	{
		categoryRoutes.GET("/", categoryController.All)
		categoryRoutes.POST("/", categoryController.Insert)       // Memanggil fungsi Insert dari controller
		categoryRoutes.GET("/:id", categoryController.FindByID)
		categoryRoutes.PUT("/:id", categoryController.Update)
		categoryRoutes.DELETE("/:id", categoryController.Delete)  // Memanggil fungsi Delete dari controller
	}
	r.Run(":9900")
}

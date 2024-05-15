// main.go

package main

import (
	"github.com/ErlanggaWebdev/cart-service/config"
	"github.com/ErlanggaWebdev/cart-service/controller"
	"github.com/ErlanggaWebdev/cart-service/repository"
	"github.com/ErlanggaWebdev/cart-service/service"
	"github.com/gin-gonic/gin"
	"gorm.io/gorm"
)

var (
	db             *gorm.DB                  = config.SetupDatabaseConnection()
	cartRepository repository.CartRepository = repository.NewCartRepository(db)
	CartService    service.CartService       = service.NewCartService(cartRepository)
	cartController controller.CartController = controller.NewCartController(CartService)
)

// membuat variable db dengan nilai setup database connection
func main() {
	defer config.CloseDatabaseConnection(db)
	r := gin.Default()

	cartRoutes := r.Group("/api/carts")
	{
		cartRoutes.GET("/", cartController.All)
		cartRoutes.POST("/", cartController.Insert)
		cartRoutes.PUT("/:id", cartController.Update)
		cartRoutes.DELETE("/:id", cartController.Delete)
	}
	r.Run(":9902")
}

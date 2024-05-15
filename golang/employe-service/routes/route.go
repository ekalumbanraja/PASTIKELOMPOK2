// route/route.go

package route

import (
	controller "EMPLOYE-SERVICE/controllers"

	"github.com/gin-gonic/gin"
)

func SetupRouter() *gin.Engine {
    r := gin.Default()

    // Route untuk karyawan
    employee := r.Group("/employees")
    {
        employee.GET("/", controller.GetEmployees)
        employee.GET("/:id", controller.GetEmployee)
        employee.POST("/", controller.CreateEmployee)
        employee.PUT("/:id", controller.UpdateEmployee)
        employee.DELETE("/:id", controller.DeleteEmployee)
    }

    return r
}

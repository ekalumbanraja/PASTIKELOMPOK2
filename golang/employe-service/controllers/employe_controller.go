// controller/employee_controller.go

package controller

import (
	"net/http"

	"EMPLOYE-SERVICE/config"
	model "EMPLOYE-SERVICE/models"

	"github.com/gin-gonic/gin"
)

func GetEmployees(c *gin.Context) {
    var employees []model.Employee
    config.DB.Find(&employees)
    c.JSON(http.StatusOK, employees)
}

func GetEmployee(c *gin.Context) {
    var employee model.Employee
    id := c.Param("id")
    if err := config.DB.First(&employee, id).Error; err != nil {
        c.JSON(http.StatusNotFound, gin.H{"error": "Employee not found"})
        return
    }
    c.JSON(http.StatusOK, employee)
}

func CreateEmployee(c *gin.Context) {
    var employee model.Employee
    if err := c.ShouldBindJSON(&employee); err != nil {
        c.JSON(http.StatusBadRequest, gin.H{"error": err.Error()})
        return
    }
    config.DB.Create(&employee)
    c.JSON(http.StatusCreated, employee)
}

func UpdateEmployee(c *gin.Context) {
    var employee model.Employee
    id := c.Param("id")
    if err := config.DB.First(&employee, id).Error; err != nil {
        c.JSON(http.StatusNotFound, gin.H{"error": "Employee not found"})
        return
    }
    if err := c.ShouldBindJSON(&employee); err != nil {
        c.JSON(http.StatusBadRequest, gin.H{"error": err.Error()})
        return
    }
    config.DB.Save(&employee)
    c.JSON(http.StatusOK, employee)
}

func DeleteEmployee(c *gin.Context) {
    var employee model.Employee
    id := c.Param("id")
    if err := config.DB.First(&employee, id).Error; err != nil {
        c.JSON(http.StatusNotFound, gin.H{"error": "Employee not found"})
        return
    }
    config.DB.Delete(&employee)
    c.JSON(http.StatusOK, gin.H{"message": "Employee deleted successfully"})
}

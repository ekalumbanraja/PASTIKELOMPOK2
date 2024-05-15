package controllers

import (
	"SLIDER-SERVICE/config"
	"SLIDER-SERVICE/models"
	"net/http"

	"github.com/gin-gonic/gin"
)

// GetAllSliders mengembalikan semua data slider
func GetAllSliders(c *gin.Context) {
	var sliders []models.Slider
	config.DB.Find(&sliders)
	c.JSON(http.StatusOK, gin.H{"data": sliders})
}

// GetSlider mengembalikan data slider berdasarkan ID
func GetSlider(c *gin.Context) {
	var slider models.Slider
	id := c.Param("id")
	if err := config.DB.First(&slider, id).Error; err != nil {
		c.JSON(http.StatusNotFound, gin.H{"error": "Slider not found!"})
		return
	}
	c.JSON(http.StatusOK, gin.H{"data": slider})
}

// CreateSlider membuat data slider baru
func CreateSlider(c *gin.Context) {
	var input models.Slider
	if err := c.ShouldBindJSON(&input); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	slider := models.Slider{
		ImageURL: input.ImageURL,
		Caption:  input.Caption,
	}

	if err := config.DB.Create(&slider).Error; err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Failed to create slider"})
		return
	}

	c.JSON(http.StatusOK, gin.H{"data": slider})
}

// UpdateSlider mengupdate data slider berdasarkan ID
func UpdateSlider(c *gin.Context) {
	var slider models.Slider
	id := c.Param("id")
	if err := config.DB.First(&slider, id).Error; err != nil {
		c.JSON(http.StatusNotFound, gin.H{"error": "Slider not found!"})
		return
	}

	var input models.Slider
	if err := c.ShouldBindJSON(&input); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	config.DB.Model(&slider).Updates(input)
	c.JSON(http.StatusOK, gin.H{"data": slider})
}

// DeleteSlider menghapus data slider berdasarkan ID
func DeleteSlider(c *gin.Context) {
	var slider models.Slider
	id := c.Param("id")
	if err := config.DB.First(&slider, id).Error; err != nil {
		c.JSON(http.StatusNotFound, gin.H{"error": "Slider not found!"})
		return
	}

	config.DB.Delete(&slider)
	c.JSON(http.StatusOK, gin.H{"data": true})
}

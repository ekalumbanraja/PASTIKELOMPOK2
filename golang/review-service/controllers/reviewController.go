package controllers

import (
	"REVIEW-SERVICE/config"
	"REVIEW-SERVICE/models"
	"net/http"

	"github.com/gin-gonic/gin"
)

// CreateReview creates a new review
func CreateReview(c *gin.Context) {
	var review models.Review
	if err := c.ShouldBindJSON(&review); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	config.DB.Create(&review)
	c.JSON(http.StatusOK, gin.H{"data": review})
}

// FindReviews retrieves all reviews
func FindReviews(c *gin.Context) {
	var reviews []models.Review
	config.DB.Find(&reviews)
	c.JSON(http.StatusOK, gin.H{"data": reviews})
}

// FindReview retrieves a review by its ID
func FindReview(c *gin.Context) {
	var review models.Review
	if err := config.DB.Where("id = ?", c.Param("id")).First(&review).Error; err != nil {
		c.JSON(http.StatusNotFound, gin.H{"error": "Review not found"})
		return
	}

	c.JSON(http.StatusOK, gin.H{"data": review})
}

// UpdateReview updates an existing review
func UpdateReview(c *gin.Context) {
	var review models.Review
	if err := config.DB.Where("id = ?", c.Param("id")).First(&review).Error; err != nil {
		c.JSON(http.StatusNotFound, gin.H{"error": "Review not found"})
		return
	}

	if err := c.ShouldBindJSON(&review); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	config.DB.Save(&review)
	c.JSON(http.StatusOK, gin.H{"data": review})
}

// DeleteReview deletes a review by its ID
func DeleteReview(c *gin.Context) {
	var review models.Review
	if err := config.DB.Where("id = ?", c.Param("id")).First(&review).Error; err != nil {
		c.JSON(http.StatusNotFound, gin.H{"error": "Review not found"})
		return
	}

	config.DB.Delete(&review)
	c.JSON(http.StatusOK, gin.H{"data": true})
}

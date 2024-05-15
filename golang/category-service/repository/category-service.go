package repository

import (
	"github.com/ErlanggaWebdev/category-service/models"
	"gorm.io/gorm"
)

type CategoryRepository interface {
	InsertCategory(category models.Category) models.Category
	UpdateCategory(category models.Category) models.Category
	All() []models.Category
	FindByID(CategoryID uint) models.Category
	DeleteCategory(category models.Category)
}

type categoryConnection struct {
	connection *gorm.DB
}

func NewCategoryRepository(db *gorm.DB) CategoryRepository {
	return &categoryConnection{
		connection: db,
	}
}

func (db *categoryConnection) InsertCategory(category models.Category) models.Category {
	db.connection.Save(&category)
	return category
}

func (db *categoryConnection) UpdateCategory(category models.Category) models.Category {
	db.connection.Save(&category)
	return category
}

func (db *categoryConnection) All() []models.Category {
	var categories []models.Category
	db.connection.Find(&categories)
	return categories
}

func (db *categoryConnection) FindByID(categoryID uint) models.Category {
	var category models.Category
	db.connection.Find(&category, categoryID)
	return category
}

func (db *categoryConnection) DeleteCategory(category models.Category) {
	db.connection.Delete(&category)
}

package repositories

import (
	"ABOUTUS-SERVICE/models"

	"gorm.io/gorm"
)

type AboutUsRepository struct {
	DB *gorm.DB
}

func NewAboutUsRepository(db *gorm.DB) *AboutUsRepository {
	return &AboutUsRepository{DB: db}
}

func (r *AboutUsRepository) CreateAboutUs(aboutus *models.AboutUs) error {
	return r.DB.Create(aboutus).Error
}

func (r *AboutUsRepository) GetAboutUs() ([]models.AboutUs, error) {
	var aboutus []models.AboutUs
	err := r.DB.Find(&aboutus).Error
	return aboutus, err
}

func (r *AboutUsRepository) GetAboutUsByID(id uint) (*models.AboutUs, error) {
	var aboutus models.AboutUs
	err := r.DB.First(&aboutus, id).Error
	return &aboutus, err
}

func (r *AboutUsRepository) UpdateAboutUs(aboutus *models.AboutUs) error {
	return r.DB.Save(aboutus).Error
}

func (r *AboutUsRepository) DeleteAboutUs(id uint) error {
	return r.DB.Delete(&models.AboutUs{}, id).Error
}

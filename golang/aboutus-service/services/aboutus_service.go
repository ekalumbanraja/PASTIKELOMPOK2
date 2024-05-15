package services

import (
	"ABOUTUS-SERVICE/models"
	"ABOUTUS-SERVICE/repositories"
)

type AboutUsService struct {
	Repo *repositories.AboutUsRepository
}

func NewAboutUsService(repo *repositories.AboutUsRepository) *AboutUsService {
	return &AboutUsService{Repo: repo}
}

func (s *AboutUsService) CreateAboutUs(aboutus *models.AboutUs) error {
	return s.Repo.CreateAboutUs(aboutus)
}

func (s *AboutUsService) GetAboutUs() ([]models.AboutUs, error) {
	return s.Repo.GetAboutUs()
}

func (s *AboutUsService) GetAboutUsByID(id uint) (*models.AboutUs, error) {
	return s.Repo.GetAboutUsByID(id)
}

func (s *AboutUsService) UpdateAboutUs(aboutus *models.AboutUs) error {
	return s.Repo.UpdateAboutUs(aboutus)
}

func (s *AboutUsService) DeleteAboutUs(id uint) error {
	return s.Repo.DeleteAboutUs(id)
}

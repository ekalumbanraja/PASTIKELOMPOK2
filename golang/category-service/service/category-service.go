package service

import (
	"log"

	"github.com/ErlanggaWebdev/category-service/dto"
	"github.com/ErlanggaWebdev/category-service/models"
	"github.com/ErlanggaWebdev/category-service/repository"
	"github.com/mashingan/smapping"
)

// CategoryService is a contract about something that this service can do
type CategoryService interface {
	Insert(b dto.CategoryCreateDTO) models.Category
	Update(b dto.CategoryUpdateDTO) models.Category
	Delete(b models.Category)
	All() []models.Category
	FindByID(categoryID uint64) models.Category
}

type categoryService struct {
	categoryRepository repository.CategoryRepository
}

// NewCategoryService creates a new instance of CategoryService
func NewCategoryService(categoryRepository repository.CategoryRepository) CategoryService {
	return &categoryService{
		categoryRepository: categoryRepository,
	}
}

func (service *categoryService) All() []models.Category {
	return service.categoryRepository.All()
}

func (service *categoryService) FindByID(categoryID uint64) models.Category {

	id := uint(categoryID)
	return service.categoryRepository.FindByID(id)
}

func (service *categoryService) Insert(b dto.CategoryCreateDTO) models.Category {
	category := models.Category{}
	err := smapping.FillStruct(&category, smapping.MapFields(&b))
	if err != nil {
		log.Fatalf("Failed map %v", err)
	}

	res := service.categoryRepository.InsertCategory(category)
	return res
}

func (service *categoryService) Update(b dto.CategoryUpdateDTO) models.Category {
	category := models.Category{}
	err := smapping.FillStruct(&category, smapping.MapFields(&b))
	if err != nil {
		log.Fatalf("Failed map %v", err)
	}

	res := service.categoryRepository.UpdateCategory(category)
	return res
}

func (service *categoryService) Delete(b models.Category) {
	service.categoryRepository.DeleteCategory(b)
}

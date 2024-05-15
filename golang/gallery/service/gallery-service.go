package service

import (
	"log"

	"github.com/ekalumbanraja/golang_gin_gorm_JWT/dto"
	"github.com/ekalumbanraja/golang_gin_gorm_JWT/entity"
	"github.com/ekalumbanraja/golang_gin_gorm_JWT/repository"
	"github.com/mashingan/smapping"
)

type GalleryService interface {
	Insert(b dto.GalleryCreateDTO) entity.Gallery
	Update(b dto.GalleryUpdateDTO) entity.Gallery
	Delete(b entity.Gallery)
	All() []entity.Gallery
	FindByID(galleryID uint) entity.Gallery
}

type galleryService struct {
	galleryRepository repository.GalleryRepository
}

func NewGalleryService(galleryRepository repository.GalleryRepository) GalleryService {
	return &galleryService{
		galleryRepository: galleryRepository,
	}
}

func (service *galleryService) All() []entity.Gallery {
	return service.galleryRepository.AllGalleries()
}

func (service *galleryService) FindByID(galleryID uint) entity.Gallery {
	return service.galleryRepository.FindByID(galleryID)
}

func (service *galleryService) Insert(b dto.GalleryCreateDTO) entity.Gallery {
	gallery := entity.Gallery{}
	err := smapping.FillStruct(&gallery, smapping.MapFields(&b))
	if err != nil {
		log.Fatalf("Failed map %v", err)
	}

	res := service.galleryRepository.InsertGallery(gallery)
	return res
}

func (service *galleryService) Update(b dto.GalleryUpdateDTO) entity.Gallery {
	gallery := entity.Gallery{}
	err := smapping.FillStruct(&gallery, smapping.MapFields(&b))
	if err != nil {
		log.Fatalf("Failed map %v", err)
	}

	res := service.galleryRepository.UpdateGallery(gallery)
	return res
}

func (service *galleryService) Delete(b entity.Gallery) {
	service.galleryRepository.DeleteGallery(b)
}

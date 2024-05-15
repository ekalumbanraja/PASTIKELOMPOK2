package repository

import (
	"github.com/ekalumbanraja/golang_gin_gorm_JWT/entity"
	"gorm.io/gorm"
)

type GalleryRepository interface {
	InsertGallery(gallery entity.Gallery) entity.Gallery
	UpdateGallery(gallery entity.Gallery) entity.Gallery
	AllGalleries() []entity.Gallery
	FindByID(galleryID uint) entity.Gallery
	DeleteGallery(gallery entity.Gallery)
}

type galleryConnection struct {
	connection *gorm.DB
}

func NewGalleryRepository(db *gorm.DB) GalleryRepository {
	return &galleryConnection{
		connection: db,
	}
}

func (db *galleryConnection) InsertGallery(gallery entity.Gallery) entity.Gallery {
	db.connection.Save(&gallery)
	return gallery
}

func (db *galleryConnection) UpdateGallery(gallery entity.Gallery) entity.Gallery {
	db.connection.Save(&gallery)
	return gallery
}

func (db *galleryConnection) AllGalleries() []entity.Gallery {
	var galleries []entity.Gallery
	db.connection.Find(&galleries)
	return galleries
}

func (db *galleryConnection) FindByID(galleryID uint) entity.Gallery {
	var gallery entity.Gallery
	db.connection.First(&gallery, galleryID)
	return gallery
}


func (db *galleryConnection) DeleteGallery(gallery entity.Gallery) {
	db.connection.Delete(&gallery)
}

package dto

type GalleryUpdateDTO struct {
	ID          uint   `json:"id" form:"id" binding:"required"`
	Title       string `json:"title" form:"title" binding:"required,min=3,max=255"`
	Description string `json:"description" form:"description" binding:"required,min=3,max=255"`
	Image       string `json:"image" form:"image" binding:"required,url"`
}

type GalleryCreateDTO struct {
	Title       string `json:"title" form:"title" binding:"required,min=3,max=255"`
	Description string `json:"description" form:"description" binding:"required,min=3,max=255"`
	Image       string `json:"image" form:"image" binding:"required,url"`
}

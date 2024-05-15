package dto

type CategoryUpdateDTO struct {
	ID            uint   `json:"id" form:"id" binding:"required"`
	Category_Name string `json:"category_name" form:"category_name" binding:"required,min=3,max=255"`
}

type CategoryCreateDTO struct {
	Category_Name string `json:"category_name" form:"category_name" binding:"required,min=3,max=255"`
}

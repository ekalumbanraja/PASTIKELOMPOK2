package models

import "gorm.io/gorm"

type Category struct {
	gorm.Model
	Category_Name string `gorm:"type:varchar(255)" json:"category_name"`
}

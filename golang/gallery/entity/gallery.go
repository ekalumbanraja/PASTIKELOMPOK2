package entity

import "gorm.io/gorm"

type Gallery struct {
	gorm.Model
	ID          uint   `gorm:"primaryKey" json:"id"`
	Title       string `gorm:"type:varchar(255)" json:"title"`
	Description string `gorm:"type:varchar(255)" json:"description"`
	Image       string `gorm:"type:varchar(255)" json:"image"`
}

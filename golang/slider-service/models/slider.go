package models

type Slider struct {
	ID       uint   `gorm:"primaryKey"`
	ImageURL string `gorm:"size:255"`
	Caption  string `gorm:"type:text"`
}

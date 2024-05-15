// model/employee.go

package model

type Employee struct {
	ID        uint   `gorm:"primaryKey"`
	Name      string `json:"name"`
	Age       uint   `json:"age"`
	Gender    string `json:"gender"`
	Religion  string `json:"religion"`
	Role      string `json:"role"`
}

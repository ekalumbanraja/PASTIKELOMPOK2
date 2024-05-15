// repository/cart-repository.go

package repository

import (
	"github.com/ErlanggaWebdev/cart-service/models"
	"gorm.io/gorm"
)

type CartRepository interface {
	InsertCart(cart models.Cart) models.Cart
	UpdateCart(cart models.Cart) models.Cart
	All(userID uint64) []models.Cart
	DeleteCart(cart models.Cart)
}

type cartConnection struct {
	connection *gorm.DB
}

func NewCartRepository(db *gorm.DB) CartRepository {
	return &cartConnection{
		connection: db,
	}
}

func (db *cartConnection) InsertCart(cart models.Cart) models.Cart {
	db.connection.Save(&cart)
	return cart
}

func (db *cartConnection) UpdateCart(cart models.Cart) models.Cart {
	db.connection.Save(&cart)
	return cart
}

func (db *cartConnection) All(userID uint64) []models.Cart {
	var carts []models.Cart
	db.connection.Find(&carts, "user_id = ?", userID)
	return carts
}

func (db *cartConnection) DeleteCart(cart models.Cart) {
	db.connection.Delete(&cart)
}

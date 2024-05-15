// service/cart-service.go

package service

import (
	"log"

	"github.com/ErlanggaWebdev/cart-service/dto"
	"github.com/ErlanggaWebdev/cart-service/models"
	"github.com/ErlanggaWebdev/cart-service/repository"
	"github.com/mashingan/smapping"
)

type CartService interface {
	Insert(b dto.CartCreateDTO) models.Cart
	Update(b dto.CartUpdateDTO) models.Cart
	Delete(b models.Cart)
	All(userId uint64) []models.Cart
}

type cartService struct {
	cartRepository repository.CartRepository
}

// NewCartService creates a new instance of CartService
func NewCartService(cartRepository repository.CartRepository) CartService {
	return &cartService{
		cartRepository: cartRepository,
	}
}

func (service *cartService) All(userID uint64) []models.Cart {
	return service.cartRepository.All(userID)
}

func (service *cartService) Insert(b dto.CartCreateDTO) models.Cart {
	cart := models.Cart{}
	err := smapping.FillStruct(&cart, smapping.MapFields(&b))
	if err != nil {
		log.Fatalf("Failed map %v", err)
	}

	res := service.cartRepository.InsertCart(cart)
	return res
}

func (service *cartService) Update(b dto.CartUpdateDTO) models.Cart {
	cart := models.Cart{}
	err := smapping.FillStruct(&cart, smapping.MapFields(&b))
	if err != nil {
		log.Fatalf("Failed map %v", err)
	}

	res := service.cartRepository.UpdateCart(cart)
	return res
}

func (service *cartService) Delete(b models.Cart) {
	service.cartRepository.DeleteCart(b)
}

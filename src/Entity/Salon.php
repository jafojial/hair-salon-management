<?php

namespace App\Entity;

use App\Repository\SalonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalonRepository::class)]
class Salon
{
    public const GENRE_MALE = 'H';
    public const GENRE_FEMALE = 'F';
    public const GENRE_MIXTE = 'H&F';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $quarter = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lat = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $long = null;

    #[ORM\Column(nullable: true)]
    private ?array $openHours = null;

    #[ORM\ManyToOne(inversedBy: 'salons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    /**
     * @var Collection<int, Stylist>
     */
    #[ORM\OneToMany(targetEntity: Stylist::class, mappedBy: 'salon')]
    private Collection $stylists;

    /**
     * @var Collection<int, Service>
     */
    #[ORM\OneToMany(targetEntity: Service::class, mappedBy: 'salon')]
    private Collection $services;

    /**
     * @var Collection<int, AvailabilityException>
     */
    #[ORM\OneToMany(targetEntity: AvailabilityException::class, mappedBy: 'salon')]
    private Collection $availabilityExceptions;

    /**
     * @var Collection<int, Booking>
     */
    #[ORM\OneToMany(targetEntity: Booking::class, mappedBy: 'salon')]
    private Collection $bookings;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    public function __construct()
    {
        $this->stylists = new ArrayCollection();
        $this->services = new ArrayCollection();
        $this->availabilityExceptions = new ArrayCollection();
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getQuarter(): ?string
    {
        return $this->quarter;
    }

    public function setQuarter(string $quarter): static
    {
        $this->quarter = $quarter;

        return $this;
    }

    public function getLat(): ?string
    {
        return $this->lat;
    }

    public function setLat(?string $lat): static
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLong(): ?string
    {
        return $this->long;
    }

    public function setLong(?string $long): static
    {
        $this->long = $long;

        return $this;
    }

    public function getOpenHours(): ?array
    {
        return $this->openHours;
    }

    public function setOpenHours(?array $openHours): static
    {
        $this->openHours = $openHours;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection<int, Stylist>
     */
    public function getStylists(): Collection
    {
        return $this->stylists;
    }

    public function addStylist(Stylist $stylist): static
    {
        if (!$this->stylists->contains($stylist)) {
            $this->stylists->add($stylist);
            $stylist->setSalon($this);
        }

        return $this;
    }

    public function removeStylist(Stylist $stylist): static
    {
        if ($this->stylists->removeElement($stylist)) {
            // set the owning side to null (unless already changed)
            if ($stylist->getSalon() === $this) {
                $stylist->setSalon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): static
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
            $service->setSalon($this);
        }

        return $this;
    }

    public function removeService(Service $service): static
    {
        if ($this->services->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getSalon() === $this) {
                $service->setSalon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AvailabilityException>
     */
    public function getAvailabilityExceptions(): Collection
    {
        return $this->availabilityExceptions;
    }

    public function addAvailabilityException(AvailabilityException $availabilityException): static
    {
        if (!$this->availabilityExceptions->contains($availabilityException)) {
            $this->availabilityExceptions->add($availabilityException);
            $availabilityException->setSalon($this);
        }

        return $this;
    }

    public function removeAvailabilityException(AvailabilityException $availabilityException): static
    {
        if ($this->availabilityExceptions->removeElement($availabilityException)) {
            // set the owning side to null (unless already changed)
            if ($availabilityException->getSalon() === $this) {
                $availabilityException->setSalon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): static
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings->add($booking);
            $booking->setSalon($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): static
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getSalon() === $this) {
                $booking->setSalon(null);
            }
        }

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }
}

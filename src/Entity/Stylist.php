<?php

namespace App\Entity;

use App\Repository\StylistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StylistRepository::class)]
class Stylist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'salon', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $usr = null;

    #[ORM\ManyToOne(inversedBy: 'languages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Salon $salon = null;

    #[ORM\Column]
    private array $languages = [];

    /**
     * @var Collection<int, AvailabilityException>
     */
    #[ORM\OneToMany(targetEntity: AvailabilityException::class, mappedBy: 'stylist')]
    private Collection $availabilityExceptions;

    /**
     * @var Collection<int, Booking>
     */
    #[ORM\OneToMany(targetEntity: Booking::class, mappedBy: 'stylist')]
    private Collection $bookings;

    /**
     * @var Collection<int, Review>
     */
    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: 'stylist')]
    private Collection $reviews;

    /**
     * @var Collection<int, Media>
     */
    #[ORM\OneToMany(targetEntity: Media::class, mappedBy: 'stylist')]
    private Collection $medias;

    public function __construct()
    {
        $this->availabilityExceptions = new ArrayCollection();
        $this->bookings = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->medias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsr(): ?User
    {
        return $this->usr;
    }

    public function setUsr(User $usr): static
    {
        $this->usr = $usr;

        return $this;
    }

    public function getSalon(): ?Salon
    {
        return $this->salon;
    }

    public function setSalon(?Salon $salon): static
    {
        $this->salon = $salon;

        return $this;
    }

    public function getLanguages(): array
    {
        return $this->languages;
    }

    public function setLanguages(array $languages): static
    {
        $this->languages = $languages;

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
            $availabilityException->setStylist($this);
        }

        return $this;
    }

    public function removeAvailabilityException(AvailabilityException $availabilityException): static
    {
        if ($this->availabilityExceptions->removeElement($availabilityException)) {
            // set the owning side to null (unless already changed)
            if ($availabilityException->getStylist() === $this) {
                $availabilityException->setStylist(null);
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
            $booking->setStylist($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): static
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getStylist() === $this) {
                $booking->setStylist(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setStylist($this);
        }

        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getStylist() === $this) {
                $review->setStylist(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    public function addMedia(Media $media): static
    {
        if (!$this->medias->contains($media)) {
            $this->medias->add($media);
            $media->setStylist($this);
        }

        return $this;
    }

    public function removeMedia(Media $media): static
    {
        if ($this->medias->removeElement($media)) {
            // set the owning side to null (unless already changed)
            if ($media->getStylist() === $this) {
                $media->setStylist(null);
            }
        }

        return $this;
    }
}

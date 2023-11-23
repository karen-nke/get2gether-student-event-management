
-- Dummy Clubs
INSERT INTO `clubs` (`club_name`, `description`, `subscriber_count`, `profile_image`, `contact_email`, `instagram_link`, `facebook_link`) VALUES
('Coding Club', 'Explore the world of coding and programming!', 120, 'coding_club.jpg', 'coding@example.com', 'https://instagram.com/codingclub', 'https://facebook.com/codingclub'),
('Photography Society', 'Capture the beauty around you with us!', 80, 'photography_society.jpg', 'photo@example.com', 'https://instagram.com/photography_society', 'https://facebook.com/photographysociety'),
('Sports Enthusiasts', 'Stay active, stay healthy. Join us for sports!', 150, 'sports_enthusiasts.jpg', 'sports@example.com', 'https://instagram.com/sportsenthusiasts', 'https://facebook.com/sportsenthusiasts');

-- Dummy Events 
INSERT INTO events (event_title, event_venue, start_time, end_time, start_date, end_date, event_image_path, event_description, club_id)
VALUES 
  ('Annual Charity Gala', 'Grand Ballroom, XYZ Hotel', '18:00', '23:00', '2023-12-01', '2023-12-01', 'Image/Event1.png', 'Join us for an elegant evening of fundraising and entertainment.', 1),
  ('Tech Symposium 2023', 'Conference Center, Innovation Hub', '09:00', '17:00', '2023-12-02', '2023-12-02', 'Image/Event2.png', 'Explore the latest trends and innovations in technology.', 2),
  ('Art Exhibition: Visionaries', 'Art Gallery, City Museum', '11:00', '18:00', '2023-12-03', '2023-12-03', 'Image/Event3.png', 'A showcase of visionary artists pushing the boundaries of creativity.', 3),
  ('Food Festival: Taste of the World', 'Outdoor Plaza, Downtown', '15:00', '22:00', '2023-12-04', '2023-12-04', 'Image/Event4.png', 'Savor delicious dishes from around the globe in one place.', 1),
  ('Startup Networking Mixer', 'Co-Working Space, Tech Hub', '17:30', '20:30', '2023-12-05', '2023-12-05', 'Image/Event5.png', 'Connect with fellow entrepreneurs and investors in the startup ecosystem.', 2),
  ('Music Festival: Harmony Beats', 'Main Stage, City Park', '12:00', '22:00', '2023-12-06', '2023-12-06', 'Image/Event6.png', 'Experience a day filled with diverse musical performances and positive vibes.', 3);
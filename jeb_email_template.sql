-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2019 at 09:55 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qib_confvalley`
--

-- --------------------------------------------------------

--
-- Table structure for table `jeb_email_template`
--

CREATE TABLE `jeb_email_template` (
  `id` int(11) NOT NULL,
  `on_enter_workflow` varchar(100) NOT NULL,
  `target_role` text NOT NULL,
  `description` varchar(200) NOT NULL,
  `notification_subject` varchar(100) NOT NULL,
  `notification` text NOT NULL,
  `do_reminder` tinyint(1) NOT NULL,
  `reminder_subject` varchar(100) NOT NULL,
  `reminder` text NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jeb_email_template`
--

INSERT INTO `jeb_email_template` (`id`, `on_enter_workflow`, `target_role`, `description`, `notification_subject`, `notification`, `do_reminder`, `reminder_subject`, `reminder`, `updated_at`) VALUES
(1, 'ArticleWorkflow/ba-pre-evaluate', '["journal-managing-editor"]', 'Notify Managing Editor to pre evaluate', '{journal-abbr} - Pre Evaluate Manuscript {manuscript-number}', 'Dear Managing Editor,\r\n\r\nPlease evaluate manuscript submitted as below:\r\n\r\n{manuscript-information}\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\n{journal-full-name}\r\n{journal-address}\r\n\r\nTelephone: {journal-phone1}\r\n{journal-phone2}\r\nEmail: {journal-email}', 0, 'Reminder to Pre Evaluate', 'Dear..', '2019-07-01 03:53:22'),
(2, 'ArticleWorkflow/ca-assign-reviewer', '["journal-associate-editor"]', 'Notify Associate Editor to assign reviewer', '{journal-abbr} - Assign Reviewers {manuscript-number}', 'Dear Associate Editor,\r\n\r\nPlease assign reviewers to manuscript as information below:\r\n\r\n{manuscript-information}\r\n\r\nPre Evaluate Note: {pre-evaluation-note}\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\n{journal-full-name}\r\n{journal-address}\r\n\r\nTelephone: {journal-phone1}\r\n{journal-phone2}\r\nEmail: {journal-email}', 0, 'Reminder - Assign Reviewer', 'Dear..', '2019-01-14 00:52:26'),
(3, 'Assign-notify-reviewer', '["journal-reviewer"]', 'Notify Reviewer to review manuscript', '{journal-abbr} - Review Manuscript {manuscript-number}', 'Dear Reviewer,\r\n\r\nYou are assigned as reviewer for manuscript submitted as below:\r\n\r\n{manuscript-information}\r\n\r\nPlease log in to {admin-url} to accept and review the manuscript.\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\n{journal-full-name}\r\n{journal-address}\r\n\r\nTelephone: {journal-phone1}\r\n{journal-phone2}\r\nEmail: {journal-email}', 0, '{journal-abbr} - Assign Reviewer', 'Dear..', '2019-01-07 15:29:15'),
(6, 'ArticleWorkflow/ga-response', '["journal-managing-editor"]', 'Notify Managing Editor to give response to author', '{journal-abbr} - Response to Author {manuscript-number}', 'Dear Managing Editor,\r\n\r\nPlease give response to author for manuscript as below:\r\n\r\n{manuscript-information}\r\n\r\nEvaluation Option: {evaluation-option}\r\nEvaluation Note: {evaluation-note}\r\n\r\nPlease log in to http://fkp.umk.edu.my/portal to give response to the author.\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\n{journal-full-name}\r\n{journal-address}\r\n\r\nTelephone: {journal-phone1}\r\n{journal-phone2}\r\nEmail: {journal-email}', 0, 'Reminder - Response to Author', 'Dear..', '2019-01-07 16:18:24'),
(7, 'ArticleWorkflow/ha-correction', '["journal-author"]', 'Notify the Author to correct', '{journal-abbr} - Manuscript Correction {manuscript-number}', 'Dear Author,\r\n\r\n{response-note}\r\n\r\nBelow is the manuscript information:\r\n\r\n{manuscript-number}\r\n\r\nPlease log in to {admin-url} to make necessary actions.\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\n{journal-full-name}\r\n{journal-address}\r\n\r\nTelephone: {journal-phone1}\r\n{journal-phone2}\r\nEmail: {journal-email}', 0, 'Reminder - Manuscript Correction', 'Dear..', '2019-01-07 22:04:52'),
(8, 'ArticleWorkflow/ia-post-evaluate', '["journal-managing-editor"]', 'Notify the Managing Editor to post evaluate', '{journal-abbr} - Post Evaluate {manuscript-number}', 'Dear Managing Editor,\r\n\r\nPlease make post evaluation for manuscript submitted as below:\r\n\r\n{manuscript-information}\r\n\r\nPlease log in to http://fkp.umk.edu.my/portal to make necessary actions.\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\n{journal-full-name}\r\n{journal-address}\r\n\r\nTelephone: {journal-phone1}\r\n{journal-phone2}\r\nEmail: {journal-email}', 0, 'Reminder - Post Evaluate', 'Dear..', '2019-01-07 22:09:42'),
(13, 'ArticleWorkflow/oa-camera-ready', '["journal-managing-editor"]', 'Notify the Managing Editor to camera ready the manuscript', '{journal-abbr} - Camera Ready Manuscript {manuscript-number}', 'Dear Managing Editor,\r\n\r\nPlease do camera ready for the manuscript as below:\r\n\r\n{manuscript-information}\r\n\r\nPlease log in to http://fkp.umk.edu.my/portal to take necessary actions.\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\n{journal-full-name}\r\n{journal-address}\r\n\r\nTelephone: {journal-phone1}\r\n{journal-phone2}\r\nEmail: {journal-email}', 1, 'Reminder - Camera Ready Manuscript', 'Dear..', '2019-01-08 05:07:32'),
(14, 'ArticleWorkflow/pa-assign-journal', '["journal-managing-editor"]', 'Notify the Managing Editor to assign journal', '{journal-abbr} - Assign Journal to Manuscript {manuscript-number}', 'Dear Managing Editor,\r\n\r\nPlease assign a journal for the manuscript as below:\r\n\r\n{manuscript-information}\r\n\r\nPlease log in to http://fkp.umk.edu.my/portal to take necessary actions.\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\n{journal-full-name}\r\n{journal-address}\r\n\r\nTelephone: {journal-phone1}\r\n{journal-phone2}\r\nEmail: {journal-email}', 0, 'Reminder - Assign Journal to Manuscript', 'Dear..', '2019-01-08 05:24:55'),
(15, 'After-all-reviewers-finished', '["journal-associate-editor"]', 'Notify the Associate Editor to submit review reports', '{journal-abbr} - Submit Reviewers'' Report {manuscript-number}', 'Dear Associate Editor,\r\n\r\nPlease submit reviewers'' report for the manuscript as below:\r\n\r\n{manuscript-information}\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\n{journal-full-name}\r\n{journal-address}\r\n\r\nTelephone: {journal-phone1}\r\n{journal-phone2}\r\nEmail: {journal-email}', 0, 'Reminder - Submit Reviewers'' Report', 'Dear..', '2019-01-07 15:53:52'),
(16, 'Author-submission', '["journal-author"]', 'Notify the Author of manuscript submission', '{journal-abbr} - Manuscript Submission {manuscript-number}', 'Dear Author,\r\n\r\nThank you for your submission of your manuscript as below:\r\n\r\n{manuscript-information}\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\n{journal-full-name}\r\n{journal-address}\r\n\r\nTelephone: {journal-phone1}\r\n{journal-phone2}\r\nEmail: {journal-email}', 0, 'null', 'null', '2019-01-07 11:57:33'),
(17, 'ArticleWorkflow/ra-reject', '["journal-author"]', 'Notify the Author about the rejection', '{journal-abbr} - Unaccepted Manuscript {manuscript-number}', 'Dear Author,\r\n\r\nPlease be noted that the manuscript submitted as below is not accepted:\r\n\r\n{manuscript-information}\r\n\r\nEditor Note: {reject-note}\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\n{journal-full-name}\r\n{journal-address}\r\n\r\nTelephone: {journal-phone1}\r\n{journal-phone2}\r\nEmail: {journal-email}', 0, 'title', 'Dear..', '2019-01-08 05:34:05'),
(18, 'ArticleWorkflow/sa-withdraw-request', '["journal-managing-editor"]', 'Notify the Managing Editor about withdraw request', '{journal-abbr} - Request to Withdraw {manuscript-number}', 'Dear Managing Editor,\r\n\r\nPlease consider on withdraw request for the manuscript as below:\r\n\r\nAuthor Note: {withdraw-note}\r\n\r\n{manuscript-information}\r\n\r\nPlease log in to http://fkp.umk.edu.my/portal to approve the withdrawal.\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\n{journal-full-name}\r\n{journal-address}\r\n\r\nTelephone: {journal-phone1}\r\n{journal-phone2}\r\nEmail: {journal-email}', 0, 'null', 'Dear..', '2019-01-08 05:58:29'),
(19, 'ArticleWorkflow/ta-withdraw', '["journal-managing-editor"]', 'Notify the Managing Editor about withdraw request', '{journal-abbr} - Request to Withdraw {manuscript-number}', 'Dear Author,\r\n\r\nPlease note that your manuscript has been withdrew.\r\n\r\n{manuscript-information}\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\n{journal-full-name}\r\n{journal-address}\r\n\r\nTelephone: {journal-phone1}\r\n{journal-phone2}\r\nEmail: {journal-email}', 0, 'null', 'Dear..', '2019-01-14 01:02:42'),
(20, 'Author-accept', '["journal-author"]', 'Notify the Author of manuscript acceptance', '{journal-abbr} - Manuscript Acceptance {manuscript-number}', 'Dear Author,\r\n\r\nCongratulation, your manuscript has been accepted.\r\n\r\n{manuscript-information}\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\n{journal-full-name}\r\n{journal-address}\r\n\r\nTelephone: {journal-phone1}\r\n{journal-phone2}\r\nEmail: {journal-email}', 0, 'null', 'null', '2019-01-07 11:57:33'),
(21, 'Appreciate-reviewer', '["journal-reviewer"]', 'Appreciate Reviewer after review', '{journal-abbr} - Appreciation on Review Manuscript {manuscript-number}', 'Dear Reviewer,\r\n\r\nThank you for your review on manuscript as below.\r\n\r\n{manuscript-information}\r\n\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\n{journal-full-name}\r\n{journal-address}\r\n\r\nTelephone: {journal-phone1}\r\n{journal-phone2}\r\nEmail: {journal-email}', 0, '{journal-abbr} - Appreciation on Review', 'Dear..', '2019-01-07 15:29:15'),
(22, 'Appointment-reviewer-accepted', '["journal-reviewer"]', 'Note to Reviewer after accept appointment', '{journal-abbr} - Acceptance on Reviewing Manuscript {manuscript-number}', 'Dear Reviewer,\r\n\r\nThank you for your acceptance to review manuscript as below.\r\n\r\n{manuscript-information}\r\n\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\n{journal-full-name}\r\n{journal-address}\r\n\r\nTelephone: {journal-phone1}\r\n{journal-phone2}\r\nEmail: {journal-email}', 0, '{journal-abbr} - Acceptance on Review', 'Dear..', '2019-01-07 15:29:15'),
(23, 'Assign-notify-reviewer-external-first', '["journal-reviewer"]', 'Notify Reviewer (first time - admin creation) to review manuscript', '{journal-abbr} - Invitation to Review Manuscript {manuscript-number}', 'Dear Prof./Associate Prof./Dr./Mr.,\r\n\r\nKindly be informed that you are invited to  review a manuscript as information below:\r\n\r\n{manuscript-information}\r\n\r\nPlease log in to {journal-url} to accept and review the manuscript.\r\n\r\nUsername: {email}\r\nPassword: {email}\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\n{journal-full-name}\r\n{journal-address}\r\n\r\nTelephone: {journal-phone1}\r\n{journal-phone2}\r\nEmail: {journal-email}', 0, '{journal-abbr} - Assign Reviewer', 'Dear..', '2019-03-03 00:01:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jeb_email_template`
--
ALTER TABLE `jeb_email_template`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jeb_email_template`
--
ALTER TABLE `jeb_email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

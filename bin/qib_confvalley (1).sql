-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2019 at 06:48 AM
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
-- Table structure for table `jeb_article`
--

DROP TABLE IF EXISTS `jeb_article`;
CREATE TABLE `jeb_article` (
  `id` int(11) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `manuscript_no` varchar(200) NOT NULL,
  `yearly_number` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pay_amount` decimal(11,2) NOT NULL,
  `title` text NOT NULL,
  `keyword` text NOT NULL,
  `abstract` text NOT NULL,
  `reference` text NOT NULL,
  `scope_id` tinyint(2) NOT NULL,
  `status` varchar(100) NOT NULL,
  `submission_file` varchar(200) NOT NULL,
  `updated_at` datetime NOT NULL,
  `draft_at` datetime NOT NULL,
  `submit_at` datetime NOT NULL,
  `pre_evaluate_at` datetime NOT NULL,
  `pre_evaluate_by` int(11) NOT NULL,
  `payment_submit_at` datetime NOT NULL,
  `payment_file` text NOT NULL,
  `payment_note` text NOT NULL,
  `payment_amount` decimal(11,2) NOT NULL,
  `payment_verified_at` datetime NOT NULL,
  `associate_editor` int(11) NOT NULL,
  `review_file` varchar(200) NOT NULL,
  `pre_evaluate_note` text NOT NULL,
  `asgn_reviewer_at` datetime NOT NULL,
  `asgn_associate_at` datetime NOT NULL,
  `asgn_reviewer_by` int(11) NOT NULL,
  `review_at` datetime NOT NULL,
  `review_submit_at` datetime NOT NULL,
  `recommend_by` int(11) NOT NULL,
  `recommend_at` datetime NOT NULL,
  `recommend_note` text NOT NULL,
  `recommend_option` tinyint(1) NOT NULL,
  `evaluate_option` tinyint(1) NOT NULL,
  `evaluate_note` text NOT NULL,
  `evaluate_by` int(11) NOT NULL,
  `evaluate_at` datetime NOT NULL,
  `response_by` int(11) NOT NULL,
  `response_at` datetime NOT NULL,
  `response_note` text NOT NULL,
  `response_option` tinyint(2) NOT NULL,
  `correction_at` datetime NOT NULL,
  `correction_note` text NOT NULL,
  `correction_file` varchar(100) NOT NULL,
  `post_evaluate_by` int(11) NOT NULL,
  `post_evaluate_at` datetime NOT NULL,
  `assistant_editor` int(11) NOT NULL,
  `galley_proof_at` datetime NOT NULL,
  `galley_proof_by` int(11) NOT NULL,
  `galley_proof_note` text NOT NULL,
  `galley_file` varchar(200) NOT NULL,
  `finalise_at` datetime NOT NULL,
  `finalise_option` tinyint(1) NOT NULL,
  `finalise_note` text NOT NULL,
  `finalise_file` varchar(200) NOT NULL,
  `asgn_profrdr_at` datetime NOT NULL,
  `asgn_profrdr_by` int(11) NOT NULL,
  `asgn_profrdr_note` text NOT NULL,
  `proof_reader` int(11) NOT NULL,
  `post_finalise_at` datetime NOT NULL,
  `post_finalise_by` int(11) NOT NULL,
  `postfinalise_file` varchar(200) NOT NULL,
  `post_finalise_note` text NOT NULL,
  `proofread_at` datetime NOT NULL,
  `proofread_by` int(11) NOT NULL,
  `proofread_note` text NOT NULL,
  `proofread_file` varchar(200) NOT NULL,
  `camera_ready_at` datetime NOT NULL,
  `camera_ready_by` int(11) NOT NULL,
  `camera_ready_note` text NOT NULL,
  `cameraready_file` varchar(200) NOT NULL,
  `assign_journal_at` datetime NOT NULL,
  `journal_at` datetime NOT NULL,
  `journal_by` int(11) NOT NULL,
  `journal_issue_id` int(11) NOT NULL,
  `reject_at` datetime NOT NULL,
  `reject_by` int(11) NOT NULL,
  `reject_note` text NOT NULL,
  `publish_number` varchar(10) NOT NULL,
  `doi_ref` varchar(200) NOT NULL,
  `withdraw_by` int(11) NOT NULL,
  `withdraw_at_status` varchar(100) NOT NULL,
  `withdraw_at` datetime NOT NULL,
  `withdraw_note` text NOT NULL,
  `withdraw_request_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jeb_article_author`
--

DROP TABLE IF EXISTS `jeb_article_author`;
CREATE TABLE `jeb_article_author` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jeb_article_reviewer`
--

DROP TABLE IF EXISTS `jeb_article_reviewer`;
CREATE TABLE `jeb_article_reviewer` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `scope_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 => ''Appoint'', 10 => ''Review In Progress'', 20 => ''Completed'', 30 => ''Reject'', 40 => ''Canceled'', 50 => ''Error''',
  `q_1` tinyint(1) NOT NULL,
  `q_2` tinyint(1) NOT NULL,
  `q_3` tinyint(1) NOT NULL,
  `q_4` tinyint(1) NOT NULL,
  `q_5` tinyint(1) NOT NULL,
  `q_6` tinyint(1) NOT NULL,
  `q_7` tinyint(1) NOT NULL,
  `q_8` tinyint(1) NOT NULL,
  `q_9` tinyint(1) NOT NULL,
  `q_10` tinyint(1) NOT NULL,
  `q_11` tinyint(1) NOT NULL,
  `q_1_note` text NOT NULL,
  `q_2_note` text NOT NULL,
  `q_3_note` text NOT NULL,
  `q_4_note` text NOT NULL,
  `q_5_note` text NOT NULL,
  `q_6_note` text NOT NULL,
  `q_7_note` text NOT NULL,
  `q_8_note` text NOT NULL,
  `q_9_note` text NOT NULL,
  `q_10_note` text NOT NULL,
  `q_11_note` text NOT NULL,
  `review_option` tinyint(1) NOT NULL,
  `review_note` text NOT NULL,
  `reviewed_file` varchar(200) NOT NULL,
  `review_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `completed_at` datetime NOT NULL,
  `cancel_at` datetime NOT NULL,
  `reject_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jeb_associate`
--

DROP TABLE IF EXISTS `jeb_associate`;
CREATE TABLE `jeb_associate` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `institution` varchar(200) NOT NULL,
  `country_id` int(11) NOT NULL,
  `admin_creation` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jeb_associate`
--

INSERT INTO `jeb_associate` (`id`, `user_id`, `institution`, `country_id`, `admin_creation`) VALUES
(1, 2, 'UMK', 18, 0),
(2, 3, 'UMK', 1, 1),
(10, 4, 'UUU', 20, 1),
(11, 5, 'UMK', 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jeb_email_template`
--

DROP TABLE IF EXISTS `jeb_email_template`;
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
(1, 'ArticleWorkflow/ba-pre-evaluate', '["journal-managing-editor"]', 'Notify Managing Editor to pre evaluate', '{journal-abbr} - Pre Evaluate Manuscript {manuscript-number}', 'Dear Managing Editor,\r\n\r\nPlease evaluate manuscript submitted as below:\r\n\r\n{manuscript-information}\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\nJournal of Entrepreneurship and Business\r\nFaculty of Entrepreneurship and Business\r\nUniversiti Malaysia Kelantan\r\n\r\nKampus Kota, Karung Berkunci 36,\r\nPengkalan Chepa, 16100\r\nKota Bharu, Kelantan, Malaysia\r\n\r\nTelephone: 609 7717251\r\nFax: 609 7717252\r\nEmail: jeb.fkp@umk.edu.my', 0, 'Reminder to Pre Evaluate', 'Dear..', '2019-01-07 11:54:28'),
(2, 'ArticleWorkflow/ca-assign-reviewer', '["journal-associate-editor"]', 'Notify Associate Editor to assign reviewer', '{journal-abbr} - Assign Reviewers {manuscript-number}', 'Dear Associate Editor,\r\n\r\nPlease assign reviewers to manuscript as information below:\r\n\r\n{manuscript-information}\r\n\r\nPre Evaluate Note: {pre-evaluation-note}\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\nJournal of Entrepreneurship and Business\r\nFaculty of Entrepreneurship and Business\r\nUniversiti Malaysia Kelantan\r\n\r\nKampus Kota, Karung Berkunci 36,\r\nPengkalan Chepa, 16100\r\nKota Bharu, Kelantan, Malaysia\r\n\r\nTelephone: 609 7717251\r\nFax: 609 7717252\r\nEmail: jeb.fkp@umk.edu.my', 0, 'JEB Reminder - Assign Reviewer', 'Dear..', '2019-01-14 00:52:26'),
(3, 'Assign-notify-reviewer', '["journal-reviewer"]', 'Notify Reviewer to review manuscript', '{journal-abbr} - Review Manuscript {manuscript-number}', 'Dear Reviewer,\r\n\r\nYou are assigned as reviewer for manuscript submitted as below:\r\n\r\n{manuscript-information}\r\n\r\nPlease log in to http://fkp.umk.edu.my/jeb to accept and review the manuscript.\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\nJournal of Entrepreneurship and Business\r\nFaculty of Entrepreneurship and Business\r\nUniversiti Malaysia Kelantan\r\n\r\nKampus Kota, Karung Berkunci 36,\r\nPengkalan Chepa, 16100\r\nKota Bharu, Kelantan, Malaysia\r\n\r\nTelephone: 609 7717251\r\nFax: 609 7717252\r\nEmail: jeb.fkp@umk.edu.my', 0, '{journal-abbr} - Assign Reviewer', 'Dear..', '2019-01-07 15:29:15'),
(6, 'ArticleWorkflow/ga-response', '["journal-managing-editor"]', 'Notify Managing Editor to give response to author', '{journal-abbr} - Response to Author {manuscript-number}', 'Dear Managing Editor,\r\n\r\nPlease give response to author for manuscript as below:\r\n\r\n{manuscript-information}\r\n\r\nEvaluation Option: {evaluation-option}\r\nEvaluation Note: {evaluation-note}\r\n\r\nPlease log in to http://fkp.umk.edu.my/portal to give response to the author.\r\n\r\nSincerely,\r\n\r\nEditorial Committees\r\nJournal of Entrepreneurship and Business\r\nFaculty of Entrepreneurship and Business\r\nUniversiti Malaysia Kelantan\r\n\r\nKampus Kota, Karung Berkunci 36,\r\nPengkalan Chepa, 16100\r\nKota Bharu, Kelantan, Malaysia\r\n\r\nTelephone: 609 7717251\r\nFax: 609 7717252', 0, 'JEB Reminder - Response to Author', 'Dear..', '2019-01-07 16:18:24'),
(7, 'ArticleWorkflow/ha-correction', '["journal-author"]', 'Notify the Author to correct', '{journal-abbr} - Manuscript Correction {manuscript-number}', 'Dear Author,\r\n\r\n{response-note}\r\n\r\nBelow is the manuscript information:\r\n\r\n{manuscript-number}\r\n\r\nPlease log in to http://fkp.umk.edu.my/jeb to make necessary actions.\r\n\r\nSincerely,\r\n\r\n{footer-from}', 0, 'JEB Reminder - Manuscript Correction', 'Dear..', '2019-01-07 22:04:52'),
(8, 'ArticleWorkflow/ia-post-evaluate', '["journal-managing-editor"]', 'Notify the Managing Editor to post evaluate', '{journal-abbr} - Post Evaluate {manuscript-number}', 'Dear Managing Editor,\r\n\r\nPlease make post evaluation for manuscript submitted as below:\r\n\r\n{manuscript-information}\r\n\r\nPlease log in to http://fkp.umk.edu.my/portal to make necessary actions.\r\n\r\nSincerely,\r\n\r\n{footer-from}', 0, 'JEB Reminder - Post Evaluate', 'Dear..', '2019-01-07 22:09:42'),
(13, 'ArticleWorkflow/oa-camera-ready', '["journal-managing-editor"]', 'Notify the Managing Editor to camera ready the manuscript', '{journal-abbr} - Camera Ready Manuscript {manuscript-number}', 'Dear Managing Editor,\r\n\r\nPlease do camera ready for the manuscript as below:\r\n\r\n{manuscript-information}\r\n\r\nPlease log in to http://fkp.umk.edu.my/portal to take necessary actions.\r\n\r\nSincerely,\r\n\r\n{footer-from}', 1, 'JEB Reminder - Camera Ready Manuscript', 'Dear..', '2019-01-08 05:07:32'),
(14, 'ArticleWorkflow/pa-assign-journal', '["journal-managing-editor"]', 'Notify the Managing Editor to assign journal', '{journal-abbr} - Assign Journal to Manuscript {manuscript-number}', 'Dear Managing Editor,\r\n\r\nPlease assign a journal for the manuscript as below:\r\n\r\n{manuscript-information}\r\n\r\nPlease log in to http://fkp.umk.edu.my/portal to take necessary actions.\r\n\r\nSincerely,\r\n\r\n{footer-from}', 0, 'JEB Reminder - Assign Journal to Manuscript', 'Dear..', '2019-01-08 05:24:55'),
(15, 'After-all-reviewers-finished', '["journal-associate-editor"]', 'Notify the Associate Editor to submit review reports', '{journal-abbr} - Submit Reviewers'' Report {manuscript-number}', 'Dear Associate Editor,\r\n\r\nPlease submit reviewers'' report for the manuscript as below:\r\n\r\n{manuscript-information}\r\n\r\nSincerely,\r\n\r\n{footer-from}', 0, 'JEB Reminder - Submit Reviewers'' Report', 'Dear..', '2019-01-07 15:53:52'),
(16, 'Author-submission', '["journal-author"]', 'Notify the Author of manuscript submission', '{journal-abbr} - Manuscript Submission {manuscript-number}', 'Dear Author,\r\n\r\nThank you for your submission of your manuscript as below:\r\n\r\n{manuscript-information}\r\n\r\nSincerely,\r\n\r\n{footer-from}', 0, 'null', 'null', '2019-01-07 11:57:33'),
(17, 'ArticleWorkflow/ra-reject', '["journal-author"]', 'Notify the Author about the rejection', '{journal-abbr} - Unaccepted Manuscript {manuscript-number}', 'Dear Author,\r\n\r\nPlease be noted that the manuscript submitted as below is not accepted:\r\n\r\n{manuscript-information}\r\n\r\nEditor Note: {reject-note}\r\n\r\nSincerely,\r\n\r\n{footer-from}', 0, 'title', 'Dear..', '2019-01-08 05:34:05'),
(18, 'ArticleWorkflow/sa-withdraw-request', '["journal-managing-editor"]', 'Notify the Managing Editor about withdraw request', '{journal-abbr} - Request to Withdraw {manuscript-number}', 'Dear Managing Editor,\r\n\r\nPlease consider on withdraw request for the manuscript as below:\r\n\r\nAuthor Note: {withdraw-note}\r\n\r\n{manuscript-information}\r\n\r\nPlease log in to http://fkp.umk.edu.my/portal to approve the withdrawal.\r\n\r\nSincerely,\r\n\r\n{footer-from}', 0, 'null', 'Dear..', '2019-01-08 05:58:29'),
(19, 'ArticleWorkflow/ta-withdraw', '["journal-managing-editor"]', 'Notify the Managing Editor about withdraw request', '{journal-abbr} - Request to Withdraw {manuscript-number}', 'Dear Author,\r\n\r\nPlease note that your manuscript has been withdrew.\r\n\r\n{manuscript-information}\r\n\r\nSincerely,\r\n\r\n{footer-from}', 0, 'null', 'Dear..', '2019-01-14 01:02:42'),
(20, 'Author-accept', '["journal-author"]', 'Notify the Author of manuscript acceptance', '{journal-abbr} - Manuscript Acceptance {manuscript-number}', 'Dear Author,\r\n\r\nCongratulation, your manuscript has been accepted.\r\n\r\n{manuscript-information}\r\n\r\nSincerely,\r\n\r\n{footer-from}', 0, 'null', 'null', '2019-01-07 11:57:33'),
(21, 'Appreciate-reviewer', '["journal-reviewer"]', 'Appreciate Reviewer after review', '{journal-abbr} - Appreciation on Review Manuscript {manuscript-number}', 'Dear Reviewer,\r\n\r\nThank you for your review on manuscript as below.\r\n\r\n{manuscript-information}\r\n\r\n\r\nSincerely,\r\n\r\n{footer-from}', 0, '{journal-abbr} - Appreciation on Review', 'Dear..', '2019-01-07 15:29:15'),
(22, 'Appointment-reviewer-accepted', '["journal-reviewer"]', 'Note to Reviewer after accept appointment', '{journal-abbr} - Acceptance on Reviewing Manuscript {manuscript-number}', 'Dear Reviewer,\r\n\r\nThank you for your acceptance to review manuscript as below.\r\n\r\n{manuscript-information}\r\n\r\n\r\nSincerely,\r\n\r\n{footer-from}', 0, '{journal-abbr} - Acceptance on Review', 'Dear..', '2019-01-07 15:29:15'),
(23, 'Assign-notify-reviewer-external-first', '["journal-reviewer"]', 'Notify Reviewer (first time - admin creation) to review manuscript', '{journal-abbr} - Invitation to Review Manuscript {manuscript-number}', 'Dear Prof./Associate Prof./Dr./Mr.,\r\n\r\nKindly be informed that you are invited to  review a manuscript as information below:\r\n\r\n{manuscript-information}\r\n\r\nPlease log in to http://jeb.umk.edu.my to accept and review the manuscript.\r\n\r\nUsername: {email}\r\nPassword: {email}\r\n\r\nSincerely,\r\n\r\n{footer-from}', 0, '{journal-abbr} - Assign Reviewer', 'Dear..', '2019-03-03 00:01:37');

-- --------------------------------------------------------

--
-- Table structure for table `jeb_journal`
--

DROP TABLE IF EXISTS `jeb_journal`;
CREATE TABLE `jeb_journal` (
  `id` int(11) NOT NULL,
  `journal_name` varchar(200) NOT NULL,
  `journal_name2` varchar(200) NOT NULL,
  `journal_abbr` varchar(100) NOT NULL,
  `journal_url` varchar(200) NOT NULL,
  `journal_doi` varchar(100) NOT NULL,
  `journal_issn` varchar(100) NOT NULL,
  `journal_email` varchar(200) NOT NULL,
  `phone1` varchar(100) NOT NULL,
  `phone2` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `journal_address` text NOT NULL,
  `about` text NOT NULL,
  `editorial_board` text NOT NULL,
  `submission_guideline` text NOT NULL,
  `publication_ethics` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jeb_journal`
--

INSERT INTO `jeb_journal` (`id`, `journal_name`, `journal_name2`, `journal_abbr`, `journal_url`, `journal_doi`, `journal_issn`, `journal_email`, `phone1`, `phone2`, `created_at`, `updated_at`, `journal_address`, `about`, `editorial_board`, `submission_guideline`, `publication_ethics`) VALUES
(1, 'International Journal of', 'Entrepreneurship, Organization and Business ', 'IJEOB', 'http://ijeob.com', '10.11111/ijeob', '1111-5678', 'ijeobofficial@gmail.com', '09-774 3100', '010 342 3095', '2019-06-13 14:24:49', '2019-06-13 14:24:49', '1830 - C, Pengkalan Nangka, \r\n16100 Kota Bharu, Kelantan', 'The International Journal of Entrepreneurship, Organization and Business (IJEOB) is an academic, refereed journal published quarterly (March, June, September and December). This journal provides open access to its content on the principle that making research journal and academic manuscript freely available to the public supports a greater global exchange of knowledge. IJEOB publishes articles and theoretical reviews. IJEOB aims to address conceptual paper, book & article review, theoretical and empirical research issues that impact the development of current business trends as an educational and scientific discipline, and promote its efficiency in the economic, social and cultural contexts.', '<div id="contentDetail">\r\n<p style="text-align: left;" align="center"><strong>Chief Editor</strong></p>\r\n<p style="text-align: left;" align="center">Assoc. Prof. Dr. Zulkifli Mohamed Udin - Universiti Utara Malaysia</p>\r\n<p style="text-align: left;" align="center"><strong>&nbsp;</strong></p>\r\n<p style="text-align: left;" align="center"><strong>Editorial Board/Reviewer</strong></p>\r\n<p style="text-align: left;" align="center">Dr. Lee Khai Loon &ndash; DRB-Hicom University</p>\r\n<p style="text-align: left;" align="center">Dr. Murat Mahad - International University of Malaya Wales</p>\r\n<p style="text-align: left;" align="center">Dr. Zahari Abu Bakar - DRB-Hicom University</p>\r\n<p style="text-align: left;" align="center">Dr. Mas Rina Mustaffa &ndash; Universiti Putera Malaysia</p>\r\n<p style="text-align: left;" align="center">Dr. Norbayah Mohd Suki &ndash; Universiti Malaysia Sabah</p>\r\n<p style="text-align: left;" align="center">Dr Wan Nurhayati Wan Ab Rahman &ndash; Universiti Putra Malaysia</p>\r\n<p style="text-align: left;" align="center">Dr Gusman Nawanir - Universiti Utara Malaysia&nbsp;</p>\r\n<p style="text-align: left;" align="center">Ezanee Mohamed Elias &ndash; Universiti Utara Malaysia</p>\r\n<p style="text-align: left;" align="center">Dr. Shatina Saad &ndash; Universiti Teknologi Mara</p>\r\n<p style="text-align: left;" align="center">Anis Amilah &ndash; Universiti Teknologi Mara</p>\r\n<p style="text-align: left;" align="center">Muhammad Naqib Mat Yunoh - Universiti Malaysia Kelantan</p>\r\n<p style="text-align: left;" align="center">Dr. Norazlina Khamis - Universiti Malaysia Sabah</p>\r\n<p style="text-align: left;" align="center">Dr. Mad Khir Johari B. Abdullah - Universiti Teknologi Mara</p>\r\n<p style="text-align: left;" align="center">Dr. Zarul Fitri Bin Zaaba - Universiti Sains Malaysia</p>\r\n<p style="text-align: left;" align="center">Dr. Mazni Omar - Universiti Utara Malaysia</p>\r\n<p style="text-align: left;" align="center">Kpl Dr. Helmi Md Rais - Universiti Teknologi Petronas</p>\r\n<p style="text-align: left;" align="center">Dr. Awanis Romli - Universiti Malaysia Pahang</p>\r\n<p style="text-align: left;" align="center">Dr. Mohd Saiful Azad -&nbsp;Universiti Malaysia Pahang</p>\r\n<p style="text-align: left;" align="center">Dr. Ahmad Nazari Bin Mohd Rose - Universiti Sultan Zainal Abidin</p>\r\n<p style="text-align: left;" align="center">Dr. Nor Hapiza Mohd Ariffin - Universiti Teknologi Mara</p>\r\n<p style="text-align: left;" align="center">Dr. Nasuha Lee Abdullah - Universiti Sains Malaysia</p>\r\n<p style="text-align: left;" align="center"><strong>&nbsp;</strong>Dr. Nor Zakiah Binti Yahaya - Universiti Sains Malaysia</p>\r\n<p style="text-align: left;" align="center">Prof. Madya. Dr. Marzanah A. Jabar - Universiti Putra Malaysia</p>\r\n<p style="text-align: left;" align="center">Dr. Aslinda Bin Hassan - Universiti Teknikal Malaysia Melaka</p>\r\n<p style="text-align: left;" align="center">&nbsp;Prof. Madya. Dr. Yusmadi Yah Bin Jusoh - Universiti Putra Malaysia</p>\r\n<p style="text-align: left;" align="center">Dr. Nur Nabilah Shahidan - Universiti Malaysia Kelantan</p>\r\n<p style="text-align: left;" align="center">Dr. Mardawani Mohamad - Universiti Malaysia Kelantan</p>\r\n<p style="text-align: left;" align="center">Assoc. Prof. Dr. Fatimah Sidi - Universiti Putra Malaysia</p>\r\n<p style="text-align: left;" align="center">Dr. Mohamad Ridhuan Mat Dangi - Universiti Teknologi Mara</p>\r\n<p style="text-align: left;" align="center">Dr. Ahmad Shahrizal Muhamad</p>\r\n<p style="text-align: left;" align="center">&nbsp;</p>\r\n<p style="text-align: left;" align="center"><strong>Co Editor</strong></p>\r\n<p style="text-align: left;" align="center">Norhaslinda Mohd Kamil -&nbsp;Global Academic Excellence</p>\r\n<p style="text-align: left;" align="center">Zafira Zainudin - Global Acaemic Excellence</p>\r\n<p align="center">&nbsp;</p>\r\n<p align="center">&nbsp;</p>\r\n</div>', '<div id="contentDetail"><br />Please log in to submit a manuscript, or register if you have not any account with EDUSAGE Network.<br /><br />\r\n<ul>\r\n<li>Manuscripts acceptance will be provided to the corresponding author within 72 hours for the respective manuscript submitted.</li>\r\n<li>1-month rapid review process with peer-review standards</li>\r\n<li>Timeline of processing from Submission to Publication is 2 month.</li>\r\n<li>Manuscripts will be published within 7 days of acceptance after done the review stage and correction stage.</li>\r\n</ul>\r\n<br /><br />Please download the [<a href="http://egax.org/jmscms/templates/Journal Template_JISTM_english version.docx" target="_blank" rel="noopener">Full Article English</a>] template here for the English version or [<a href="http://egax.org/jmscms/templates/Journal Template_JISTM_malay version.docx" target="_blank" rel="noopener">Full Article Malay</a>] for Malay version</div>', '<div id="contentDetail"><br /><br />\r\n<p>This is the statement of ethics for International Journal of Accounting, Finance and Business&nbsp;(IJAFB)&nbsp;published by Global Academic Excellence (GAE). This statement was&nbsp;adapted from the principles of the Committee on Publication Ethics (COPE) and covers the code&nbsp;of ethics for the chief editor, editorial board members, reviewers and authors.</p>\r\n<p>&nbsp;</p>\r\n<p><br /><strong>DUTIES OF AUTHORS</strong></p>\r\n<ul>\r\n<li>Have the responsibility of ensuring only new and original work is submitted.</li>\r\n<li>Must not reproduce work that has been previously published in other journals.</li>\r\n<li>Must not submit any articles that are being reviewed or considered by the journal to other&nbsp;journals simultaneously.</li>\r\n<li>Are only allowed to publish their work elsewhere after receiving a formal rejection from the&nbsp;journal or if their request to withdraw their work is officially accepted by the journal.</li>\r\n<li>Must inform the Chief Editor or the publisher of any inaccuracy of data in their published&nbsp;work so that correction or retraction of article can be done.</li>\r\n<li>Should make significant contributions and be held accountable for any shortcoming in their&nbsp;work.</li>\r\n</ul>\r\n<p><br /><strong>DUTIES OF REVIEWERS</strong></p>\r\n<ul>\r\n<li>Must disclose any competing interest before agreeing to review a submission</li>\r\n<li>Can refuse to review any submission due to a conflict of interest or inadequate knowledge.</li>\r\n<li>Review all submissions objectively, fairly and professionally.</li>\r\n<li>Reveal any ethical misconduct encountered while reviewing to the Chief Editor for further&nbsp;action.</li>\r\n<li>Should ensure the originality of a submission and be alert to any plagiarism and redundant&nbsp;publication.</li>\r\n<li>Must not discuss the content of the submission without permission.</li>\r\n<li>Adhere to the time allocated for the review process. Requests for extension to review the&nbsp;submission are at the discretion of the Chief Editor.</li>\r\n</ul>\r\n<p><br /><strong>DUTIES OF EDITORIAL BOARD MEMBERS</strong></p>\r\n<ul>\r\n<li>Actively contribute to the development and the greater good of the journal.</li>\r\n<li>Act as ambassadors for the journal.</li>\r\n<li>Continuously support and promote the journal.</li>\r\n<li>Review any work assigned to them.</li>\r\n</ul>\r\n<p><br /><strong>DUTIES OF CHIEF EDITOR</strong></p>\r\n<ul>\r\n<li>Evaluate manuscripts fairly and solely on their intellectual merit.</li>\r\n<li>Ensure confidentiality of manuscripts and not disclose any information regarding&nbsp;manuscripts to anyone other than the people involved in the publishing process.</li>\r\n<li>Has the responsibility to decide when and which articles are to be published.</li>\r\n<li>Actively seek the views of board members, reviewers and authors on how to improve/increase the image and visibility of the journal.</li>\r\n<li>Give clear instructions to potential contributors on the submission process and what is&nbsp;expected of the authors.</li>\r\n<li>Ensure appropriate reviewers are selected/ identified for the reviewing process.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>PLAGIARISM</strong></p>\r\n<p>Authors should submit only original work that is not plagiarized, and has not been published or being considered elsewhere.&nbsp; Appropriate software may be used by the editorial office to check for similarities of submitted manuscripts with existing literature. Inclusion of fraudulent or knowingly inaccurate statements are unacceptable. Work and/or words from other publications must be appropriately cited or quoted.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>REPORTING</strong></p>\r\n<p>Authors should state their results clearly, honestly, and without fabrication, falsification or inappropriate data manipulation. The methods used in the work should be clearly and unambiguously described so that the findings can be repeated and confirmed by other researchers.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>CONFLICTS OF INTEREST</strong>&nbsp;</p>\r\n<p>A statement on conflict of interest must be included in the manuscript if authors receive any support that might be construed to influence the results or interpretation of their manuscript. All sources of financial support for the project should be disclosed.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>AUTHORSHIP AND COLLABORATION</strong></p>\r\n<p>Name of authors listed in a paper should be limited to those who have made a significant contribution to the report. Only those who have made significant contributions should be listed as co-authors. Others who have participated in certain substantive aspects of the work must be acknowledged or listed as contributors. It is the duty of the corresponding author to ensure that all appropriate co-authors and no inappropriate co-authors are included on the paper.&nbsp; All co-authors must approve the final version of the paper and agree to the version of the paper before submission.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>MULTIPLE OR REDUNDANT</strong></p>\r\n<p>Authors should not publish manuscripts describing essentially the same research output in more than one journal or primary publication. A similar manuscript should not be submitted to more than one journal concurrently as this constitutes as unethical publishing behavior and is unacceptable.</p>\r\n</div>');

-- --------------------------------------------------------

--
-- Table structure for table `jeb_journal_issue`
--

DROP TABLE IF EXISTS `jeb_journal_issue`;
CREATE TABLE `jeb_journal_issue` (
  `id` int(11) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `issue_month` varchar(50) NOT NULL,
  `issue_year` year(4) NOT NULL,
  `issue_name` varchar(200) NOT NULL,
  `volume` int(11) NOT NULL,
  `issue` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `description` text NOT NULL,
  `published_at` datetime NOT NULL,
  `archived_at` datetime NOT NULL,
  `is_special` tinyint(1) NOT NULL,
  `submit_start` date NOT NULL,
  `submit_end` date NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jeb_journal_issue`
--

INSERT INTO `jeb_journal_issue` (`id`, `journal_id`, `issue_month`, `issue_year`, `issue_name`, `volume`, `issue`, `status`, `description`, `published_at`, `archived_at`, `is_special`, `submit_start`, `submit_end`, `updated_at`) VALUES
(1, 1, 'September', 2019, 'June 2019', 1, 1, 20, 'hai', '2019-06-28 00:00:00', '0000-00-00 00:00:00', 0, '2019-06-01', '2019-06-30', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jeb_journal_scope`
--

DROP TABLE IF EXISTS `jeb_journal_scope`;
CREATE TABLE `jeb_journal_scope` (
  `id` int(11) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `scope_id` int(11) NOT NULL,
  `scope_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jeb_journal_scope`
--

INSERT INTO `jeb_journal_scope` (`id`, `journal_id`, `scope_id`, `scope_cat`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1),
(6, 1, 6, 1),
(7, 1, 7, 1),
(8, 1, 8, 1),
(9, 1, 9, 1),
(10, 1, 10, 1),
(11, 1, 11, 1),
(12, 1, 12, 3),
(13, 1, 13, 3),
(14, 1, 14, 3),
(15, 1, 7, 3),
(16, 1, 15, 3),
(17, 1, 16, 3),
(18, 1, 17, 3),
(19, 1, 18, 3),
(20, 1, 19, 3),
(21, 1, 20, 3),
(22, 1, 21, 3),
(23, 1, 22, 3),
(24, 1, 23, 3),
(25, 1, 24, 3);

-- --------------------------------------------------------

--
-- Table structure for table `jeb_review_form`
--

DROP TABLE IF EXISTS `jeb_review_form`;
CREATE TABLE `jeb_review_form` (
  `id` int(11) NOT NULL,
  `form_quest` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jeb_review_form`
--

INSERT INTO `jeb_review_form` (`id`, `form_quest`) VALUES
(1, 'The objectives of the manuscript were clear.'),
(2, 'The manuscript topic is important.'),
(3, 'The manuscript should be of interest to a large audience.'),
(4, 'The literature review was thorough given the objectives.'),
(5, 'References were complete and were appropriate.'),
(6, 'The methodology was appropriate for the conclusions drawn.'),
(7, 'The analysis was done correctly.'),
(8, 'The results of analysis were correctly interpreted and/or conclusions were sound.'),
(9, 'Tables and figures were appropriate and adequate.'),
(10, 'Formatting and structure was appropriate.'),
(11, 'The manuscript was relatively free of issues of grammar, punctuation, and such.');

-- --------------------------------------------------------

--
-- Table structure for table `jeb_scope`
--

DROP TABLE IF EXISTS `jeb_scope`;
CREATE TABLE `jeb_scope` (
  `id` int(11) NOT NULL,
  `scope_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jeb_scope`
--

INSERT INTO `jeb_scope` (`id`, `scope_name`) VALUES
(1, 'Entrepreneurship education'),
(2, 'Social entrepreneurship'),
(3, 'Sustainable entrepreneurship'),
(4, 'New Enterprise Development'),
(5, 'Corporate entrepreneurship'),
(6, 'Small business'),
(7, 'Innovation'),
(8, 'Incubators'),
(9, 'Woman entrepreneur'),
(10, 'Agropreneur'),
(11, 'Technopreneruship'),
(12, 'Critical Management Studies'),
(13, 'Entrepreneurship'),
(14, 'Human Resource Management'),
(15, 'International Business'),
(16, 'Leadership'),
(17, 'Management Information System'),
(18, 'Marketing'),
(19, 'Operation Management'),
(20, 'Organization Theory'),
(21, 'Organizational Behavior'),
(22, 'Small and Medium Enterprise (SMEs)'),
(23, 'Strategic Management'),
(24, 'Supply Chain Management');

-- --------------------------------------------------------

--
-- Table structure for table `jeb_scope_cat`
--

DROP TABLE IF EXISTS `jeb_scope_cat`;
CREATE TABLE `jeb_scope_cat` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jeb_scope_cat`
--

INSERT INTO `jeb_scope_cat` (`id`, `cat_name`) VALUES
(1, 'Entrepreneurship'),
(2, 'Organization'),
(3, 'Business');

-- --------------------------------------------------------

--
-- Table structure for table `jeb_setting`
--

DROP TABLE IF EXISTS `jeb_setting`;
CREATE TABLE `jeb_setting` (
  `id` int(11) NOT NULL,
  `template_file` varchar(100) NOT NULL,
  `pay_amount` decimal(11,2) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jeb_setting`
--

INSERT INTO `jeb_setting` (`id`, `template_file`, `pay_amount`, `updated_at`) VALUES
(1, '2019/01619A/template_15463948165c2c1cc05c6527.06909770.doc', '500.00', '2019-01-02 10:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `jeb_user_scope`
--

DROP TABLE IF EXISTS `jeb_user_scope`;
CREATE TABLE `jeb_user_scope` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `scope_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jeb_user_scope`
--

INSERT INTO `jeb_user_scope` (`id`, `user_id`, `scope_id`) VALUES
(1, 3, 5),
(2, 4, 2),
(3, 4, 4),
(4, 4, 6),
(5, 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

DROP TABLE IF EXISTS `subscriber`;
CREATE TABLE `subscriber` (
  `id` int(11) NOT NULL,
  `subs_email` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jeb_article`
--
ALTER TABLE `jeb_article`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `manuscript_no` (`manuscript_no`);

--
-- Indexes for table `jeb_article_author`
--
ALTER TABLE `jeb_article_author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jeb_article_reviewer`
--
ALTER TABLE `jeb_article_reviewer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jeb_associate`
--
ALTER TABLE `jeb_associate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jeb_email_template`
--
ALTER TABLE `jeb_email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jeb_journal`
--
ALTER TABLE `jeb_journal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jeb_journal_issue`
--
ALTER TABLE `jeb_journal_issue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jeb_journal_scope`
--
ALTER TABLE `jeb_journal_scope`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jeb_review_form`
--
ALTER TABLE `jeb_review_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jeb_scope`
--
ALTER TABLE `jeb_scope`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jeb_scope_cat`
--
ALTER TABLE `jeb_scope_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jeb_setting`
--
ALTER TABLE `jeb_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jeb_user_scope`
--
ALTER TABLE `jeb_user_scope`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subs_email` (`subs_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jeb_article`
--
ALTER TABLE `jeb_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `jeb_article_author`
--
ALTER TABLE `jeb_article_author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `jeb_article_reviewer`
--
ALTER TABLE `jeb_article_reviewer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `jeb_associate`
--
ALTER TABLE `jeb_associate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `jeb_email_template`
--
ALTER TABLE `jeb_email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `jeb_journal`
--
ALTER TABLE `jeb_journal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jeb_journal_issue`
--
ALTER TABLE `jeb_journal_issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jeb_journal_scope`
--
ALTER TABLE `jeb_journal_scope`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `jeb_scope`
--
ALTER TABLE `jeb_scope`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `jeb_scope_cat`
--
ALTER TABLE `jeb_scope_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jeb_user_scope`
--
ALTER TABLE `jeb_user_scope`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

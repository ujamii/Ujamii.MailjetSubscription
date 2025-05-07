# Ujamii.MailjetSubscription

This package adds two new form finishers for the Neos Form Builder to subscribe and unsubscribe users to/from Mailjet mailing lists.

## Installation

The package can be installed via Composer:

```bash
composer require ujamii/neos-mailjetsubscription
```

## Requirements

* Neos CMS 8.x+
* t3n/mailjet-adapter

## Configuration

Add your Mailjet API credentials to your NEOS `Configuration/Settings.yaml`:

```yaml
# Settings.yaml
t3n:
    MailJetAdapter:
        mailjet:
            clientConfiguration:
                apiKey: 'your-api-key'
                apiSecret: 'your-api-secret'
```

## Features

This package provides:

1. **MailjetSubscribeFinisher**: Adds a contact to one or more Mailjet mailing list
2. **MailjetUnsubscribeFinisher**: Removes a contact from one or more Mailjet mailing list
3. **MailjetListSelector**: A new form element which shows a set of lists to subscribe to/unsubscribe from.

## Usage

### Form Builder Integration

After installing the package, the two new finishers will be available in the Form Builder in the Neos backend as well as a new form
type for the Mailjet ContactLists the user wants to sub/unsubscribe. Backend editors have to chose from all available lists which
ones should be shown in frontend. The form field always has the name `lists`.

#### Subscribe Finisher Configuration

The Finisher expects 2 field ids to be in the form: `email` and `lists`.

#### Unsubscribe Finisher Configuration

The Finisher expects 2 field ids to be in the form: `email` and `lists`.

## DataSource for List Selection

The package includes a DataSource for selecting Mailjet lists in the Neos backend. This allows editors to choose from available lists when configuring forms.

## License

This package is licensed under the [GPLv3 license](LICENSE).

## Contribution

Contributions are welcome! Please feel free to submit a Pull Request.
